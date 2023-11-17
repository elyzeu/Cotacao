<?php

namespace App\Http\Controllers;

use App\Mail\MeuEmail;
use App\Models\Pedido;
use App\Models\pedido_items;
use App\Models\Valore;
use Illuminate\Http\Request;
use App\Models\Fornecedorwin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SeuControlador extends Controller
{
    public function manipularItensSelecionados(Request $request)
    {
        // Receba os dados JSON enviados na solicitação
        $itensSelecionados = $request->json()->all();

        // Obtenha o ID do usuário autenticado
        $userId = Auth::id();
        $user = Auth::user();

        // Crie um array para armazenar os emails diferentes
        $emailsDiferentes = [];

        // Crie um array para armazenar os detalhes dos itens por email
        $detalhesItensPorEmail = [];

        // Loop através dos itens selecionados e salve-os usando o modelo Fornecedorwin
        foreach ($itensSelecionados as $item) {
            $fornecedorwin = new Fornecedorwin();
            $fornecedorwin->pedido_id = $item['pedido_id'];
            $fornecedorwin->valor = $item['valor'];
            $fornecedorwin->user_id = $userId;
            $fornecedorwin->fornecedor_id = $item['id_fornecedor'];
            $fornecedorwin->email = $item['email'];
            $fornecedorwin->nomeproduto = $item['produto'];
            $fornecedorwin->quantidade = $item['qtd_item'];
            $fornecedorwin->data_entrega = $item['prazo'];
            $fornecedorwin->emailcomprador =  $user->email;
            $fornecedorwin->desc = $item['desc'];
            $fornecedorwin->status= 0;
            // Salve o registro
            $fornecedorwin->save();

            // Verifique se o email já está na lista de emails diferentes
            if (!in_array($item['email'], $emailsDiferentes)) {
                $emailsDiferentes[] = $item['email'];
                $detalhesItensPorEmail[$item['email']] = [];
            }

            // Adicione os detalhes deste item ao array de detalhes
            $detalhesItensPorEmail[$item['email']][] = [
                'produto' => $item['produto'],
                'quantidade' => $item['qtd_item'],
                'valor' => $item['valor'],
                'prazo' => $item['prazo'],
                'desc' => $item['desc'],
            ];
        }

        // Enviar um único email de aviso com detalhes dos itens se houver emails diferentes
        if (!empty($emailsDiferentes)) {
            foreach ($emailsDiferentes as $destinatario) {
                $aviso = "Você tem novas encomendas";
                $remetente = [
                    'email' => $user->email,
                    'nome' => $user->name,
                ];

                // Montar a mensagem com detalhes dos itens
                $mensagem = "Detalhes dos itens:\n";
                foreach ($detalhesItensPorEmail[$destinatario] as $itemDetalhe) {
                    $mensagem .= "<div style='background-color: #f9f9f9; margin-top: 20px; padding: 10px;'>";
                    $mensagem .= "<p><strong>&#x1F4E6;Produto:</strong> " . $itemDetalhe['produto'] . "</p>";
                    $mensagem .= "<p><strong>&#x1F4C4;Quantidade:</strong> " . $itemDetalhe['quantidade'] . "</p>";
                    $mensagem .= "<p ><strong>&#x1F4E6;Embalagem:</strong> " . $itemDetalhe['desc'] . "</p>";
                    $mensagem .= "<p><strong>&#x1F4B0;Valor:</strong> $" . $itemDetalhe['valor'] . "</p>";
                    $mensagem .= "<p><strong>&#x1F4C5;Data para Entregar:</strong> " . $itemDetalhe['prazo'] . "</p>";
                    $mensagem .= "</div>";
                }
                
                $assunto = 'Cotação de ' . $user->name;

                Mail::to($destinatario)->send(new MeuEmail($mensagem, $remetente, $assunto));
            }
        }

        // Deletar registros relacionados nas tabelas PedidoItem, Valore e Pedido
        foreach ($itensSelecionados as $item) {
           Valore::where('pedido_id', $item['pedido_id'])->delete();
           pedido_items::where('pedido_id', $item['pedido_id'])->delete();
           Pedido::where('id', $item['pedido_id'])->delete();
        }

        // Retorne uma resposta adequada, por exemplo, uma resposta JSON
        return response()->json([
            'mensagem' => 'Itens selecionados foram salvos com sucesso',
            'redirect' => '/dashboard',
        ]);
    }
}
