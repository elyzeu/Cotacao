<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MeuEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $remetente;
    protected $mensagem;
    protected $assunto;

    /**
     * Create a new message instance.
     *
     * @param  string  $mensagem
     * @param  array  $remetente
     * @param  string  $assunto
     */
    public function __construct($mensagem, $remetente, $assunto)
    {
        $this->mensagem = $mensagem;
        $this->remetente = $remetente;
        $this->assunto = $assunto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->assunto)
            ->from($this->remetente['email'], $this->remetente['nome'])
            ->view('emails.mensagem_html', [
                'mensagem' => $this->mensagem,
                'assunto' => $this->assunto
            ])
            ->text('emails.mensagem_plain', ['mensagem' => $this->mensagem]);
    }
    
}
