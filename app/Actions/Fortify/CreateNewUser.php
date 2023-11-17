<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Liberacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\MeuEmail;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array<string, string> $input
     */
    public function create(array $input): User
    {
        $tipo = $input['tipo'];
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        $endereco = $input['endereco'];
        $telefone = $input['telefone'];

        
        
        // Cria o usuário
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'endereco' =>  $endereco,
            'telefone' => $telefone,
            'password' => Hash::make($input['password']),
        ]);
        $dt='00/00/0000';

        // Insira o ID do usuário na tabela 'payments' no campo 'user_id'
        Liberacao::create([
            'email' => $user->email, // Define o ID do usuário
            'status' => 0
            // Outros campos de 'payments'...
        ]);

        // Dê permissões ao usuário, se necessário
        $user->givePermissionTo($tipo);

        return $user;
    }

    public function store(Request $request)
{

    $user = Auth::user();

    // Valide os dados da solicitação
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : [],
    ]);

    $tipo = $request->input('tipo');
    $emailcriado = $request->input('email');
    $endereco = $request->endereco;
    $destinatario = $emailcriado;
    $telefone = $request->telefone;

    //gera senha aleatória  com 12 caracter
    $randomPassword = Str::random(12); 

    // Cria o usuário
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'endereco' =>  $endereco,
        'telefone' => $telefone,
        'password' => Hash::make($randomPassword),
    ]);

    $dt = '00/00/0000';

    // Insira o ID do usuário na tabela 'payments' no campo 'user_id'
    Liberacao::create([
        'email' => $user->email, // Define o ID do usuário
        'status' => 0
        // Outros campos de 'payments'...
    ]);

   
        $aviso = "Sua conta foi criada com sucesso para cotações";
        $remetente = [
            'email' => $user->email,
            'nome' => $user->name,
        ];

        // Montar a mensagem com detalhes da conta
        $mensagem = "Detalhes da conta:\n";
        $texto1 = "Peça ao comprador que te cadastre na aba 'fornecedor' ";
            $mensagem .= "<div style='background-color: #f9f9f9; margin-top: 20px; padding: 10px;'>";
            $mensagem .= "<p><strong>Email:</strong> " . $emailcriado . "</p>";
            $mensagem .= "<p><strong>Senha:</strong> " . $randomPassword . "</p>";
            $mensagem .= "<p><strong>Obs:</strong> " . $texto1 . "</p>";
            $mensagem .= "</div>";
        
        
        $assunto = ''. $request->input('name').' essa é sua conta para receber pedidos ';

        Mail::to($destinatario)->send(new MeuEmail($mensagem, $remetente, $assunto));
    

    // Dê permissões ao usuário, se necessário
    $user->givePermissionTo($tipo);

    return redirect('/FornecedorViewInfo'); // Redirecione para a página desejada após a criação bem-sucedida
}

}
