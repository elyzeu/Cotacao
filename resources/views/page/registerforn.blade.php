<x-app-layout>
    <head>
    <script>
            function mascara_telefone(i){
   
   var v = i.value;
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
   }
   
   i.setAttribute("maxlength", "10");

}
        </script>
           <style>
        .btnred {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px 5px;
            border: 2px solid #000000;
            background-color: #a11217;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }
        .search-container {
                display: flex;
                align-items: center;
                justify-content: flex-end;
                margin-top: 1rem;
            }
            .help-button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        .help-button:hover{
           background-color: #0054A8;
        }
        .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fff;
    margin: 5% auto; /* Reduz a margem superior para centralizar verticalmente */
    padding: 20px;
    border: 2px solid #333333;
    width: 80%;
    max-width: 600px; /* Aumenta a largura máxima para melhor legibilidade */
    position: relative;
    border-radius: 10px; /* Adiciona cantos arredondados ao modal */
}
/* Estilos para o botão de fechar */
.close {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
}
    </style>
    </head>

    <x-slot name="header">
    <h2 class="font-semibold text-xl text-black leading-tight">
        {{ __('Criar Conta Do Fornecedor') }}
    </h2>

    <div class="search-container">
               
    <button class="help-button" onclick="mostrarAjuda()">?</button>
            </div>
</x-slot>
 

    <div class="py-12 flex justify-center items-center min-h-screen">
        <div class="max-w-md w-full space-y-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('registerforn') }}">
                    @csrf

                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" placeholder="Nome" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email"  placeholder="email@gmail.com" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>

       
                    <div class="mt-4">
                        <x-label for="telefone" value="{{ __('Telefone') }}" />
                        <x-input type="text" for="telefone" id="telefone" onkeyup="mascaraTelefone(this)" name="telefone" placeholder="(00) 0000-0000"
                required autocomplete="telefone" />
                    </div>
                    <div class="mt-4">
                        <x-label for="endereco" value="{{ __('Endereço') }}" />
                        <x-input id="endereco"  placeholder="Rua 0, Lt. 00, St. Centro.  Ou S/E" class="block mt-1 w-full" type="text" name="endereco"  required />
                    </div>
                    <div class="mt-4">
                        <x-label for="tipo" value="{{ __('Tipo de conta') }}" />
                        <select name="tipo" id="tipo">
                            <option value="2">fornecedor</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4 btnred">
                            {{ __('Cadastrar') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
 <!-- Modal de Ajuda -->
 <div id="ajudaModal" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharAjuda">&times;</span>
        <h2 style="font-weight: bold; font-size: 18px;">Criar conta fornecedor</h2>
        <br>
        <p>1. Formulário para criação de conta do fornecedor...</p>
        <br>
        <p>2. A senha será enviada por email para ele...</p>
        <br>
        <p>3. Após criar a conta, inclua o fornecedor na aba "Fornecedor".</p>
        <br>
        <p>4. Caso não tenha endereco coloque S/E</p>
        <br>
        <p>5. Sem essa conta ele não tem acesso aos seus pedidos.</p>
        
        
    </div>
</div>
</x-app-layout>


<script>
    // Função para mostrar o modal de ajuda
function mostrarAjuda() {
        var modal = document.getElementById("ajudaModal");
        modal.style.display = "block";
    }

    // Função para fechar o modal de ajuda
    function fecharAjuda() {
        var modal = document.getElementById("ajudaModal");
        modal.style.display = "none";
    }

    // Fechar o modal quando o usuário clicar fora dele
    window.onclick = function(event) {
        var modal = document.getElementById("ajudaModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Fechar o modal quando o usuário clicar no botão de fechar
    var closeBtn = document.getElementById("fecharAjuda");
    if (closeBtn) {
        closeBtn.onclick = function() {
            fecharAjuda();
        };
    }
    //mascara telefone
    function mascaraTelefone(telefone) {
  var texto = telefone.value;
  texto = texto.replace(/[^0-9]/g, '');
  if (texto.length > 0) {
    texto = '(' + texto.substring(0, 2) + ') ' + texto.substring(2, 6) + '-' + texto.substring(6, 10);
  }
  telefone.value = texto;
}
</script>
