<x-app-layout>
    <head>
        <style>
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
      
            .search-container {
                display: flex;
                align-items: center;
                justify-content: flex-end;
                margin-top: 1rem;
            }
        </style>
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitação') }}
        </h2>
        <div class="search-container">
               
                <button class="help-button" onclick="mostrarAjuda()">?</button>
            </div>
    </x-slot>



    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                
    <div style="text-align: center; background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: 10px; border-radius: 5px;"
     class="alert alert-danger">
        <ul>
          
                <li>Solicite sua liberação ao suporte</li>
       
        </ul>
    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
  <!-- Modal de Ajuda -->
  <div id="ajudaModal" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharAjuda">&times;</span>
        <h2 style="font-weight: bold; font-size: 18px;">Liberação</h2>
        <br>
        <p>1. Solicite sua liberação junto ao suporte</p>
        <br>
       
      
    </div>
</div>
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
</script>
