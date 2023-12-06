<?php
use App\Http\Controllers\ControllerValores;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SeuControlador;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagamentoController;
use App\Http\Middleware\ValidarDataVencimento;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\EstrelaMorte;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/estserachcontainer', function () {
    return view('info.est');
});



Route::group(['middleware' => 'web'], function () {
    Route::get('/LiberacaoUso', function () {
        return view('info.meuplano');
    })->name('MeuPlano');
    Route::post('/libuso', [PagamentoController::class, 'LiberacaoUso'])->name('LiberacaoUso');
});

Route::post('/atrserach', [EstrelaMorte::class, 'atrserach'])->name('atrserach');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ValidarDataVencimento::class
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'retorno'])->name('dashboard');
    
})


->group(function () {
    Route::post('/PedidoStore', [PedidoController::class, 'store'])->name('PedidoStore');
})

->group(function () {
    Route::get('/FornecedorViewInfo', [FornecedorController::class, 'listall'])->name('FornecedorViewInfo');
})
->group(function () {
    Route::post('/FornecedorStore', [FornecedorController::class, 'store'])->name('fornecedorstore');
})

->group(function () {
    Route::get('/NoValue', function () {
        return view('info.erros');
    })->name('erro');
    
})
->group(function () {
    Route::get('/RegistroFornecedor', function () {
        return view('page.registerforn');
    })->name('registerfornecedor')->middleware('permission:Comprador');
})



->group(function () {
    Route::get('/Produtos', [ProdutoController::class, 'listAll'])->name('Produtos')->middleware('permission:Comprador');
})

->group(function () {
    Route::post('/ProdutoStore', [ProdutoController::class, 'store'])->name('ProdutoStore')->middleware('permission:Comprador');
})

->group(function () {
    Route::get('/VerCotação', [PedidoController::class, 'listAll'])->name('MinhaCotacao')->middleware('permission:Comprador');
})
->group(function () {
    Route::get('Pedido/{id}/delete', [PedidoController::class, 'destroy'])->name('DeleteMinhaCotacao')->middleware('permission:Comprador');
})
->group(function () {
    Route::get('Encomenda/{id}/edit', [FornecedorController::class, 'EditEntregue'])->name('DefinirEntregue')->middleware('permission:Fornecedor');
})

->group(function () {
    Route::get('Fornecedor/{id}/delete', [FornecedorController::class, 'destroy'])->name('DeleteFornecedor')->middleware('permission:Comprador');
})
->group(function () {
    Route::get('FornecedorWinCot', [FornecedorController::class, 'listencomenda'])->name('listencomenda')->middleware('permission:Fornecedor');
})
->group(function () {
    Route::delete('/delete-pedidos/{pedidoId}', [FornecedorController::class, 'DeleteMinhaEncomenda'])->name('DeleteMinhaEncomenda')->middleware('permission:Fornecedor');
})

->group(function () {
    Route::get('Pedido/{id}/Editar', [PedidoController::class, 'editar'])->name('EditarMinhaCotação')->middleware('permission:Comprador');
})
->group(function () {
    Route::get('/CotacaoFornecedor', [PedidoController::class, 'listallfornecedor'])->name('CotacaoFornecedor')->middleware('permission:Fornecedor');
})
->group(function () {
    Route::get('Cotacao/{id}/Add/{user_id}', [ControllerValores::class, 'addValorCotacao'])->name('AddValorCotacao')->middleware('permission:Fornecedor');
})
->group(function () {
    Route::get('/MinhaCotacaoValor', [PedidoController::class, 'MinhaCotacaoValor'])->name('MinhaCotacaoValor')->middleware('permission:Comprador');
})
->group(function () {
    Route::post('/FornecedorVencedorStore', [PedidoController::class, 'CotacaoVencedorStore'])->name('FornecedorVencedor')->middleware('permission:Comprador');
})


->group(function () {
    Route::get('/Liberação', [PagamentoController::class, 'return'])->name('licaberacao')->middleware('permission:Admin');
})
->group(function () {
    Route::post('/LiberaçãoStore', [PagamentoController::class, 'store'])->name('licaberacaostore')->middleware('permission:Admin');
})
->group(function () {
    Route::post('/CreateForn', [CreateNewUser::class, 'store'])->name('registerforn')->middleware('permission:Comprador');
})


->group(function () {
Route::get('/buscar-produtos', [ProdutoController::class, 'pesquisa'])->name('buscarProdutos');
    Route::get('/PedidoView', [ProdutoController::class, 'returnview'])->name('PedidoView');
Route::get('/comprovantes', [PlanoController::class, 'showComprovantes'])->name('showComprovantes');
Route::delete('/comprovantes/{comprovanteId}', [PlanoController::class, 'deleteComprovante'])->name('delete.comprovante');
Route::post('/storeallitens', [SeuControlador::class,'manipularItensSelecionados'])->name('url-do-seu-servidor');

});


// routes/web.php
Route::get('/produtos/search', [ProdutoController::class, 'search'])->name('produto.search');
//Route::get('/produtos/all', [ProdutoController::class, 'obterProdutosJSON'])->name('produto.all');


Route::get('/enviar-email', [EmailController::class, 'enviarEmailForm']);
Route::post('/enviar-email', [EmailController::class, 'enviarEmail']);

Route::post('/atualizar/pagamento', [PlanoController::class, 'update'])->name('atualizarpagamento')->middleware('auth');


Route::post('/atrserach2', [EstrelaMorte::class, 'atrserach'])->name('atrserach');
Route::get('/MeuPlano', function () {
    return view('info.meuplano');
})->name('MeuPlano')->middleware('permission:Comprador');


//rota download app
Route::get('download-apk', function () {
    $path = storage_path('app/apk/NETSideCotacao.apk');
    $headers = [
        'Content-Type' => 'application/vnd.android.package-archive',
    ];
    return response()->download($path, 'NETSideCotacao.apk', $headers);
})->name('download.apk');

// rota de captura pra qualquer outra rota
Route::any('{any}', function () {
    return redirect('/');
})->where('any', '.*');
