<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
use App\Models\User;
use App\Models\Fornecedore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Valore;
use App\Models\Fornecedorwin;
use App\Mail\MeuEmail;
use App\Models\PedidoItem;
use Illuminate\Support\Facades\Mail;
use App\Models\Produto;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        // Preencher os campos que não são itens da tabela
        $pedido = new Pedido;
        $pedido->status = true;
        $pedido->user_id = Auth::id();
        $pedido->save(); // Salvar o pedido primeiro para obter o ID
    
        // Agora, processar os itens da tabela
        $quantidades = $request->input('quantidades');
        $observacoes = $request->input('observacoes');
        $datas = $request->input('datas');
        $produto_ids = $request->input('produto_id');
    
        // Certifique-se de que $produto_ids seja um array antes de iterar sobre ele
        if (is_array($produto_ids)) {
            // Iterar pelos itens e criar registros no banco de dados
            foreach ($produto_ids as $key => $produto_id) {
                // Encontre o produto pelo ID
                $produto = Produto::find($produto_id);
    
                // Verifique se o produto foi encontrado
                if ($produto) {
                    $item = new PedidoItem;
                    $item->pedido_id = $pedido->id;
                    $item->prazo = $datas[$key];
                    $item->qtd_item = $quantidades[$key];
                    $item->descricao = $observacoes[$key];
    
                    // Associe o produto ao item do pedido
                    $item->produto_id = $produto->nompro; // Certifique-se de que isso corresponda ao nome da coluna na tabela
    
                    // ... Outros campos ...
    
                    $item->save();
                }
            }
        }
    
        return redirect('/VerCotação');
    }
    
    
    
//Listar todos os pedidos para o comprador.    
public function listAll()
{
    $userId = Auth::id();
    
    // Usar paginate() em vez de get() para obter uma instância de LengthAwarePaginator
    $pedidos = Pedido::select('id', 'status', 'user_id')
    ->where('user_id', $userId)
    ->where('status', 1)
    ->paginate(10);

    // Carregar os itens de cada pedido
    foreach ($pedidos as $pedido) {
        $pedido->itens = PedidoItem::where('pedido_id', $pedido->id)->get();
    }
    if($pedidos->isEmpty()){
        $mensagem="Você não tem nenhum pedido aberto";
        return view('info.erros', compact('mensagem'));
    }
    else{
        $mensagem="";
    return view('info.minhacotacao', compact('pedidos', 'mensagem'));

    }
    
}


    public function destroy($id){

        Valore::where('pedido_id', $id)->delete();
        PedidoItem::where('pedido_id', $id)->delete();
        //deleta o pedido        
        Pedido::findOrFail($id)->delete();
   
      return redirect('/VerCotação');
    }

    public function editar($id, Request $request){
        // Recupere o pedido com base no ID
        $pedido = Pedido::find($id);
    
        if (!$pedido) {
            // Trate o caso em que o pedido não foi encontrado
            // Por exemplo, redirecione para uma página de erro
            return redirect('/pagina-de-erro');
        }

        Valore::where('pedido_id', $id)->delete();
        PedidoItem::where('pedido_id', $id)->delete();
       
        // Atualize o status do pedido com base no valor do campo "tipo" do formulário
        $pedido->delete();
    
        // Redirecione de volta para a página de visualização de cotação
        return redirect('/VerCotação');
    }

    public function listallfornecedor() {
        $userId = Auth::id();
        $perPage = 3;
    
        $user = User::where('id', $userId)->first();
    
        if ($user) {
            $useremail = $user->email;
    
            // Recupere os fornecedores com base no email
            $fornecedores = Fornecedore::where('email', $useremail)->get();
    
            if ($fornecedores->isNotEmpty()) {
                // Inicialize arrays para armazenar todos os pedidos e itens de pedido
                $todosPedidos = [];
                $todosItens = [];
    
                foreach ($fornecedores as $fornecedor) {
                    $fornecedor_id = $fornecedor->user_id;
    
                    // Recupere todos os pedidos associados a esse fornecedor
                    $pedidos = Pedido::where('user_id', $fornecedor_id)
                        ->where('status', 1)
                        ->get(); // Remova paginate daqui
    
                    // Itere pelos pedidos do fornecedor e recupere os itens de cada pedido
                    foreach ($pedidos as $pedido) {
                        $pedido_id = $pedido->id;
                        $itens = PedidoItem::where('pedido_id', $pedido_id)->get();
                        $todosPedidos[] = $pedido;
                        $todosItens[$pedido_id] = $itens;
                    }
                }
    
                // Após concluir a construção dos resultados, aplique a paginação
                $currentPage = request()->input('page', 1); // Obtém o número da página da solicitação
                $pagedData = array_slice($todosPedidos, ($currentPage - 1) * $perPage, $perPage);
    
                // Cria uma instância de Paginator para os pedidos
                $todosPedidos = new \Illuminate\Pagination\LengthAwarePaginator(
                    $pagedData,
                    count($todosPedidos),
                    $perPage,
                    $currentPage,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
    
                return view('info.cotacoesfornecedor', compact('todosPedidos', 'todosItens'));
            } else {
                $mensagem = "Não existem pedidos abertos";
                return view('info.erros', compact('mensagem'));
            }
        } else {
            // O usuário com o código especificado não foi encontrado.
            // Você pode querer adicionar uma lógica de tratamento de erro aqui.
        }
    }
    
    
    
    
    public function MinhaCotacaoValor(){
        $id = Auth::id();
        $statusDesejado = 1;
        $userId = $id;
    
       $pedidos = Pedido::where('user_id', $userId)
    ->where('status', $statusDesejado)
    ->get();

    
        $fornecedor = Fornecedore::where('user_id', $userId)->get();
        $valor = Valore::where('user_id', $userId)->get();
        
        if($valor->isEmpty()) {
            $mensagem = "Você não tem nenhum pedido com valor salvo";
            return view('info.erros', ['mensagem' => $mensagem]);
        } 
        else {
            return view('info.valores', compact('pedidos', 'fornecedor', 'valor', 'userId'));
        }
    }
    



}
