<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\model_has_permission;
use App\Models\Pedido;
use App\Models\PedidoItem;

class DashboardController extends Controller
{
   // public function retorno()
   // {
        
    
        //    return view('dashboard');

   // }

    //Listar todos os pedidos para o comprador.    
public function retorno()
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
    return view('dashboard', compact('pedidos', 'mensagem'));

    }
    
}
}
