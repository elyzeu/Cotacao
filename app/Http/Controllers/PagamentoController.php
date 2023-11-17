<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\model_has_permission;
use App\Models\Liberacao;

class PagamentoController extends Controller
{
    public function return(){

        return view('page.payment');

    }
    

    public function LiberacaoUso(Request $request) {
        // Verifique se já existe uma entrada com o mesmo e-mail
        $existingStatus = Liberacao::where('email', $request->email)->first();
    
        if ($existingStatus) {
            // Se a entrada já existe, atualize o status
            $existingStatus->update(['status' => $request->status]);
        } else {
            // Se a entrada não existe, crie uma nova
            $lib = new Liberacao;
            $lib->status = $request->status;
            $lib->email = $request->email;
            $lib->save();
        }
    
        return redirect('/dashboard');
    }
    
}
