<?php

namespace App\Http\Middleware;

use App\Models\model_has_permission;
use Closure;
use Carbon\Carbon;
use App\Models\Liberacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidarDataVencimento
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
                
        if ($user) {
            //pega a data de pagamento e vencimento
            $liberacao = Liberacao::where('email', $user->email)->first();

            //pega a permissao do usuario
           $permission= model_has_permission::where('model_id', $user->id)->first();
        
            if ($liberacao) {
                //$dataVencimento = Carbon::createFromFormat('d/m/Y', $payment->data_vencimento)->startOfDay();
                //$dataAtual = Carbon::now()->startOfDay();
                
                //verifica se a data de vencimento é a padrão de quando usuario cria nova conta
                //também verifica se a permissao dele é de comprador
                if ($liberacao->status == 0 && $permission->permission_id == 1) {
                    return redirect('/LiberacaoUso');
                    //se for dele deve ser redirecionado, pois deve pagar
                }

                    // verifica a data de vencimento quando ja houve pagamento ja venceu
                    //se venceu e se ele é comprador... deve pagar
              //  if ($dataVencimento < $dataAtual && $permission->permission_id == 1) {
                  //  return redirect('/LiberacaoUso');
               // }
            }
        }

        //permite ele ser direcionado aonde quer ir.
        //se for comprador tem q estar com pagamento em dias.
        //se for fornecedor, já vai direto
        return $next($request);
    }
    
    
}
