<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MeuEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function enviarEmailForm()
    {
        return view('emails.minha_view');
    }

    public function enviarEmail(Request $request)
    {
        $mensagem = $request->input('mensagem');
        $destinatario = $request->input('destinatario');
        $assunto = $request->input('assunto'); // Pega o valor do campo "assunto"


        $remetente = [
            'email' => 'elyzeumozartcardoso@gmail.com',
            'nome' => 'Elyzeu',
        ];
        
        Mail::to($destinatario)->send(new MeuEmail($mensagem, $remetente, $assunto));
          // Redirecione para a rota /dashboard após o envio bem-sucedido do e-mail
    return redirect('/dashboard');
    }
}