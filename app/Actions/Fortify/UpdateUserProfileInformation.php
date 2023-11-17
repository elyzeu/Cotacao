<?php

namespace App\Actions\Fortify;

use App\Models\Fornecedore;
use App\Models\Fornecedorwin;
use App\Models\PedidoItem;
use App\Models\User;
use App\Models\Valore;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
{
    $userId = Auth::id();

    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
    ])->validateWithBag('updateProfileInformation');

    if (isset($input['photo'])) {
        $user->updateProfilePhoto($input['photo']);
    }

    if ($input['email'] !== $user->email &&
        $user instanceof MustVerifyEmail) {
        $this->updateVerifiedUser($user, $input);
    } else {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
        ]);

        if ($user->isDirty('email') && $user->save()) {
            // O email foi alterado, e a atualização ou inserção do email foi bem-sucedida
            // Faça o tratamento apropriado aqui
            Fornecedore::where('idaux', $userId)->update(['email' => $input['email']]);
            Fornecedorwin::where('fornecedor_id', $userId)->update(['email'=> $input['email']]);
            
            // Agora, você pode excluir registros da tabela Fornecedore usando $userId
            
           
        } elseif (!$user->isDirty('email') && $user->save()) {
            // O email não foi alterado, mas a atualização ou inserção do perfil foi bem-sucedida
            // Faça o tratamento apropriado aqui, se necessário
        }
    }
}


    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
