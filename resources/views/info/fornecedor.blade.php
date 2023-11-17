<x-app-layout>

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

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
            /* css para tabela */
            table {
                border-collapse: separate;
                border-spacing: 5px;
                background-color: white;
            }

            .btnincluir {
                display: inline-block;
                padding: 10px 15px;
                margin: 10px 5px;

                background-color: #6dc900;
                color: #ffffff;
                text-decoration: none;
                font-weight: bold;
                border-radius: 5px;
                font-family: 'Montserrat', sans-serif;
            }

            .btnincluir:hover {
                background-color: #098F14;
            }


            .bg {
                background-color: rgb(196, 252, 237);
            }

            th,
            td {
                padding: 8px;
                text-decoration-color: black;
                animation-direction: alternate-reverse;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                text-align: left;
            }

            tr {
                border-bottom: 1px solid black;
            }

           

            table.a {
                table-layout: auto;
                width: 100%;
                border-bottom: 1px solid #ddd;
                position: relative;
            }
            .trh{
                background-color: white;
            }
            .trh:hover {
    background-color: #D6EEEE;
}
            /* Estilos para a janela modal */
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
                margin: 15% auto;
                padding: 20px;
                border: 2px solid #333333;
                width: 80%;
                max-width: 400px;
                position: relative;
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
        </style>
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Fornecedores') }}
        </h2>
        <div class="flex items-center justify-end mt-4">
            <x-button id="openModalButton" class="btnincluir ml-4 text-white btnred">
                {{ __('Incluir +') }}
            </x-button>
            <button class="help-button" onclick="mostrarAjuda()">?</button>
        </div>
    
    </x-slot>
    @if($mensagem)
                <div class="alert alert-danger" style="text-align: center; background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: 10px; border-radius: 5px;">
    {{ $mensagem }}
</div>

@endif
    <body>
    <div class="py-12">
   
    <div class="bg-gray-200">
   
        <x-validation-errors class="mb-4" />

    
        @foreach($fornecedores as $fornecedor)
        <div style="overflow-x:auto;">
            <table class="a">
                <thead>
                    <tr>
                        <th>Funcionário</th>
                        <th>Empresa</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Telefone</th>
                  
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="trh">
                        <td>{{ $fornecedor->funcionario }}</td>
                        <td>{{ $fornecedor->empresa }}</td>
                        <td>{{ $fornecedor->email }}</td>
                        @if($fornecedor->status == 1 )
                        <td>Ativo</td>
                        @else
                        <td>Inativo</td>
                        @endif
                        <td>{{ $fornecedor->telefone }}</td>
                       
                        <td class="editbtn">
                            <form
                                action="{{ route('DeleteFornecedor', $fornecedor->id) }}"
                                method="GET">
                                @csrf
                                @method('DELETE')
                                <button class="delete-button">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
        <!-- Adicione a seção de links de paginação abaixo da tabela -->
        {{ $fornecedores->links() }}
    </div>
</div>

    </body>
</x-app-layout>

<!-- Janela modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <!-- Botão "x" para fechar no canto superior direito -->
        <span class="close" id="closeModal">&times;</span>

        <!-- Conteúdo da janela modal (formulário de inserção de fornecedor) -->
        <form method="POST" action="{{ route('fornecedorstore') }}">
            @csrf
            <!-- Adicione aqui os campos do formulário -->

            <x-label for="funcionario" value="{{ __('Funcionario') }}" />
            <x-input id="funcionario" placeholder="nome do funcionario" type="text" name="funcionario" required
                autocomplete="funcionario" />
            <x-label for="empresa" value="{{ __('Empresa') }}" />
            <x-input id="empresa" placeholder="Nome da Empresa" type="text" name="empresa" required
                autocomplete="empresa" />
            <x-label for="email" value="{{ __('E-mail') }}" />
            <x-input id="email" placeholder="email@gmail.com" type="text" name="email" required autocomplete="email" />
            <x-label for="telefone" value="{{ __('Telefone') }}" />
            <x-input type="text" for="telefone" id="telefone" onkeyup="mascaraTelefone(this)" name="telefone" placeholder="(00) 0000-0000"
                required autocomplete="telefone" />

            <!-- Outros campos do formulário -->

            <!-- Botão para enviar o formulário -->
            <div class="flex items-center justify-end mt-4">
                <x-button id="openModalButton" class="btnincluir ml-4 text-white btnred">
                    {{ __('Salvar') }}
                </x-button>
            </div>
        </form>
    </div>
</div>


  <!-- Modal de Ajuda -->
<div id="ajudaModal" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharAjuda">&times;</span>
        <h2 style="font-weight: bold; font-size: 18px;">Cadastro de fornecedor</h2>
        <br>
        <p>1. Crie uma conta para o fornecedor antes ***clique em seu nome >>>>> Conta de Fornecedor***</p>
        <br>
        <p>2. Caso ele já tenha a conta criada, siga o proximo passo...</p>
        <br>
        <p>3. Clique em Incluir e informe os dados e salve.</p>
       <br>
        <p>4. Suas cotações aparecerão para ele</p>
    </div>
</div>

<!-- JavaScript para mostrar/ocultar a janela modal -->
<script>
    var modal = document.getElementById('myModal');
    var openModalButton = document.getElementById('openModalButton');
    var closeModalButton = document.getElementById('closeModal'); // Adicione este elemento

    openModalButton.addEventListener('click', function () {
        modal.style.display = 'block';
    });

    // JavaScript para fechar a janela modal quando clicar no botão de fechar
    closeModalButton.addEventListener('click', function () { // Altere para usar o elemento closeModal
        modal.style.display = 'none';
    });

    // Fechar a janela modal quando clicar fora dela
    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    // Impedir que o clique dentro da janela modal a feche
    modal.querySelector('.modal-content').addEventListener('click', function (event) {
        event.stopPropagation();
    });

    
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
