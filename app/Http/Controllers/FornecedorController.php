<?php

namespace App\Http\Controllers;
use App\Models\Fornecedore;
use App\Models\Fornecedorwin;
use App\Models\User;
use App\Models\Valore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\model_has_permission;

class FornecedorController extends Controller
{
    public function store(Request $request){

        $fornecedor = new Fornecedore;

        $id = Auth::id();

        $userfornecedor = User::where('email', $request->email)->first();
        $idContForn = $userfornecedor->id;

        $permission = model_has_permission::where('model_id', $idContForn)->first();

        

        if ($userfornecedor  && $permission->permission_id == 2){
        $userfornecedorId= $userfornecedor->id;
        
        $fornecedor->idaux = $userfornecedorId;
        $fornecedor->funcionario = $request->funcionario;
        $fornecedor->empresa = $request->empresa;
        $fornecedor->email = $request->email;
        $fornecedor->telefone = $request->telefone;
        $fornecedor->status = true;
        $fornecedor->user_id = $id;
        $fornecedor->save();

        return redirect('/FornecedorViewInfo');

        }
        else{
            $mensagem = "O fornecedor não pode ser cadastrado";
            return view('info.erros', ['mensagem'=>$mensagem]);
        }
    }
    
    //listagem de fornecedores para o comprador
    public function listall(){
        $userId = Auth::id();

        // Defina a quantidade de resultados por página (por exemplo, 10 resultados por página)
        $perPage = 2;
    
        // Encontre todos os fornecedores com o mesmo user_id, paginando os resultados
        $fornecedores = Fornecedore::where('user_id', $userId)->paginate($perPage);
       
        if($fornecedores->isEmpty()){

            $mensagem = "Você não cadastrou nenhum fornecedor.";
        }
        else{
            $mensagem = "";
        }
        return view('info.fornecedor', compact('fornecedores','mensagem'));
    }

    public function destroy($id){

       // dd($id);
       $idaux = Fornecedore::where('id', $id)->first();
      //dd($idaux->idaux);

        Valore::where('fornecedor_id', $idaux->idaux)->delete();
        Fornecedore::findOrFail($id)->delete();
        
   
        return redirect('/FornecedorViewInfo')->with('error','Você deletou o fornecedor');
    }
    

    public function listencomenda()
    {
        $userId = Auth::id();
        $users = User::All();
        // Usar paginate() em vez de get() para obter uma instância de LengthAwarePaginator
        $pedidos = Fornecedorwin::where('fornecedor_id', $userId)
        ->where('status', 0)    
        ->paginate(10);
    
        // Agrupe os pedidos por pedido_id
        $pedidosAgrupados = $pedidos->groupBy('pedido_id');
    
        // Carregar os itens de cada pedido
        return view('info.cotacaofornwin', compact('pedidosAgrupados', 'users'));
    }
    
    public function DeleteMinhaEncomenda($pedidoId)
{
    // Encontre e exclua todos os registros com o mesmo pedido_id
    Fornecedorwin::where('pedido_id', $pedidoId)->delete();

    
    return redirect('/FornecedorWinCot');
}

        public function EditEntregue($id){
            
            Fornecedorwin::where('pedido_id', $id)
            ->update(['status' => 1]);

            return redirect('/FornecedorWinCot');
        }
    
}
