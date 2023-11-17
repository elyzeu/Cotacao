<?php

namespace App\Http\Controllers;

use App\Models\Valore;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerValores extends Controller
{
    public function addValorCotacao($id, $user_id, Request $request){
        $idforn = Auth::id();
        
        $valor = new Valore;

        $item_id = $request->input('item_id');



        $verificacao = Valore::where('pedidoitem_id',$item_id)
        ->where('fornecedor_id', $idforn)
        ->where('pedido_id', $id)
        ->first();

        if ($verificacao) {
            // Exiba uma mensagem de erro ou redirecione o fornecedor
            return redirect('/CotacaoFornecedor')->with('error', 'Você já inseriu um valor para este pedido.');
        }

        $nomeproduto = $request->produto_id;
       // dd($nomeproduto);

        $valor->valor = $request->valor;
        $valor->nompro = $nomeproduto;
        //id do dono do pedido
        $valor->user_id = $user_id;
        //id do pedido
        $valor->pedido_id = $id;
        
        //id do fornecedor
        $valor->fornecedor_id = $idforn;

        $valor->pedidoitem_id = $request->input('item_id');

        $valor->save();
    
        return redirect('/CotacaoFornecedor');
    }
}
