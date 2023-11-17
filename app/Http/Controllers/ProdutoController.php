<?php

namespace App\Http\Controllers;
use App\Models\Produto;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function pesquisa(Request $request)
    {
        $term = $request->term;
        $perPage = 10; // Número de resultados por página
    
        $produtos = Produto::where('nompro', 'LIKE', '%' . $term . '%')
        ->orWhere('codpro', 'LIKE', "%$term%")
            ->paginate($perPage);
    
        // Formatando os resultados para o Select2
        $results = [];
        foreach ($produtos as $produto) {
            $results[] = [
                'id' => $produto->id,
                'text' => $produto->nompro,
            ];
        }
    
        // Retorne os resultados paginados
        return response()->json([
            'results' => $results,
            'pagination' => [
                'more' => $produtos->hasMorePages(),
                'page' => $produtos->currentPage(),
            ],
        ]);
    }
    
    public function returnview()
    {
        return view('page.pedido');
    }

    public function listAll(){

       $produtos = Produto::paginate(10);
 

        return view('info.produtos', ['produtos' => $produtos]);
    }
    ///public function obterProdutosJSON() {
   // $produtos = Produto::paginate(5);
    //return response()->json($produtos);
//}

    public function store(Request $request)
    {
        $produto = new Produto;
        
        $produto->nompro = $request->descricao;
        $produto->codpro = $request->codpro;
       // dd($produto);
        
        $produto->save();

        return redirect('/dashboard');

    }
    public function search(Request $request)
    {
        $search = $request->input('search');
    
        $produtos = Produto::where('nompro', 'LIKE', "%$search%")
            ->orWhere('codpro', 'LIKE', "%$search%")
            ->paginate(10); // Paginar os resultados, exibindo 10 itens por página
    
        return response()->json($produtos);
    }
    
    


}
