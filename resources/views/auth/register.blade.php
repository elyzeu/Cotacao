<x-guest-layout>
    <head>


<style>
        .btnred {
            display: inline-block;
            padding: 10px 15px;
            /*diminui o padding para tornar os botões menores */
            margin: 10px 5px;
            /*margem para separar os botões */
            border: 2px solid #000000;
            background-color: #a11217;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }

        .dnthave{
    color: white;
}
.dnthave:hover{
 color: red;   
}
h4 {
    color: #5c6bc0;
    font-size: 3em;
    margin-top: 0px;
    text-align: left;
    font-weight: lighter;
    border-bottom: 2px solid #5c6bc0;
    margin-bottom: 60px;
}
h4 {
    text-shadow: 4px 8px 12px rgba(0, 0, 0, 1);
}
h5{
  font-family: 'Source Sans Pro', sans-serif;
  font-size: 13px;
  color: #a1a4ad;
  letter-spacing: 1.5px;
  margin-top: -50px;
  margin-bottom: 40px;

}

    </style>
   
         
    
    </head>
   
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <h4>Registrar</h4>
        <h5>Crie sua conta.</h5>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-4">
                <x-label class="text-white" for="name" value="{{ __('Name') }}" />
                <x-input id="name" placeholder="Nome" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label class="text-white" for="email" value="{{ __('Email') }}" />
                <x-input id="email"  placeholder="email@gmail.com"  class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label class="text-white" for="password" value="{{ __('Password') }}" />
                <x-input id="password"  placeholder="**********"  class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label class="text-white" for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" placeholder="**********"  class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                 </div>
            <div class="mt-4">
                        <x-label class="text-white" for="telefone" value="{{ __('Telefone') }}" />
                        <x-input type="text" for="telefone" id="telefone" class="block mt-1 w-full" onkeyup="mascaraTelefone(this)" name="telefone" placeholder="(00) 0000-0000"
                required autocomplete="telefone" />
                    </div>
                    <div class="mt-4">
                        <x-label class="text-white" for="endereco" value="{{ __('Endereço') }}" />
                        <x-input id="endereco"  placeholder="Rua 0, Lt. 00, St. Centro" class="block mt-1 w-full" type="text" name="endereco"  required />
                    </div>
            <div class="mt-4">
                <x-label class="text-white" for="tipo" value="{{ __('Tipo de conta') }}" />
                <select class="text-black" name="tipo" id="tipo">
                    <option value="1">Comprador</option>
                    
                </select>
            </div>
            @if(Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms
                                    of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy
                                    Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm  text-white dnthave rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4 btnred">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
    
</x-guest-layout>
<script>
    function mascaraTelefone(telefone) {
  var texto = telefone.value;
  texto = texto.replace(/[^0-9]/g, '');
  if (texto.length > 0) {
    texto = '(' + texto.substring(0, 2) + ') ' + texto.substring(2, 6) + '-' + texto.substring(6, 10);
  }
  telefone.value = texto;
}
</script>