<x-app-layout>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <style>
            /* Estilo pra janela modal */
            /* Estilos para a janela modal */
            .h2s {
            font-size: 24px;
            color: #333; /* Cor do texto */
            background-color: #f0f0f0; /* Cor de fundo */
            padding: 10px; /* Espaçamento interno */
            border-radius: 5px; /* Cantos arredondados */
            text-align: center; /* Alinhamento de texto no centro */
            margin: 0; /* Remove margens padrão */
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


            /* ... */

            /* Additional styles for the search input and button */
            .search-container {
                display: flex;
                align-items: center;
                justify-content: flex-end;
                margin-top: 1rem;
            }

            .search-label {
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                color: #000;
                margin-right: 10px;
            }

            #descricao {
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
            }

            #buscar-btn {
                display: inline-block;
                padding: 10px 15px;
                margin-left: 10px;
                background-color: #6dc900;
                color: #ffffff;

                border-radius: 5px;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                cursor: pointer;
            }

            #buscar-btn:hover {
                background-color: #098F14;
            }

            /* Your existing styles for modal and table */
            /* ... */

            /* css para tabela */
            table {
                border-collapse: separate;
                border-spacing: 5%;
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
                padding: 1px;
                width: 38%;
                text-decoration-color: black;
                animation-direction: alternate-reverse;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                text-align: left;
            }
                .icoalign{
                    text-align: right;
                    width: 1px;
                }

            .trh {
                border-bottom: 1px solid black;
            }

            .trh:hover {
                background-color: #D6EEEE;
            }

            table.a {
                table-layout: auto;
                width: 100%;
                border-bottom: 1px solid #ddd;
                position: relative;
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
                max-width: 600px;
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

            .Align {
                text-align: right;
            }

            .editbtn {
                background-color: #FFEFD5;
                width: 1px;
                align: left;
            }

            .editbtn:hover {
                background-color: #FFE4B5;
            }
            /* Add this to your existing styles */
.table-container {
    max-height: 300px; /* Adjust the max-height as needed */
    overflow-y: auto;
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
        @media (max-width: 768px) {
            .aux{
                width: 40%;
            }

   

}
        </style>
    </head>
  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Dashboard') }}
        </h2>
        @if($pedidos->isEmpty())
      
    
        @endif
    </x-slot>
    
    @if($mensagem)
                <div class="alert alert-danger" style="text-align: center; background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: 10px; border-radius: 5px;">
                
    {{ $mensagem }}
</div>

@endif

    <body>
        
        <div class="py-12">
            
            <div class="max-w-7xl mx-auto sm:px-10 lg:px-2" >
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-gray-200">
                        @foreach($pedidos as $pedido)
                            <x-validation-errors class="mb-4" />
                            <table class="a">
    <tr data-type="header">
        <th>ID Pedido</th>
        <th>Status</th>
        <th class=" icoalign">Visualizar Itens</th>
    </tr>
    <tr class="trh">
        <td>
            <span style="font-weight: bold; color: #ff8800; font-size: 16px;"># {{ $pedido->id }}</span>
        </td>
        <td>
            @if($pedido->status == 1)
                &#x1F197; Ativo
            @else
                &#x1F512; Encerrado
            @endif
        </td>
       
    
        <td class="editbtn icoalign">
            <button class="view-items-button" data-id="{{ $pedido->id }}">
                &#x1F4E6;
            </button>
        </td>
    </tr>
</table>

                            <!-- Modal HTML (colocado dentro do loop) -->
                            <div id="myModal{{ $pedido->id }}" class="modal">
                                <div class="modal-content">
                                    <span class="close" id="closeModal{{ $pedido->id }}">&times;</span>
                                    <form
                                        action="{{ route('EditarMinhaCotação', $pedido->id) }}"
                                        method="get">
                                        @csrf
                                        <!-- Adicione aqui os campos do formulário -->
                                        <div class="mt-4">
                                            <x-label for="tipo" value="{{ __('Status Pedido') }}" />
                                            <select name="tipo" id="tipo{{ $pedido->id }}">
                                                <option value="1">&#x1F197;Ativo</option>
                                                <option value="2">&#x1F512;Encerrado</option>
                                            </select>
                                        </div>
                                        <!-- Outros campos do formulário -->
                                        <!-- Botão para enviar o formulário -->
                                        <div class="flex items-center justify-end mt-4">
                                            <x-button id="openModalButton{{ $pedido->id }}"
                                                class="btnincluir ml-4 text-white btnred">
                                                {{ __('Salvar') }}
                                            </x-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Fim do modal HTML -->

                            <!-- Modal HTML para visualização de itens (colocado dentro do loop) -->
                            <div id="itemsModal{{ $pedido->id }}" class="modal">
                                <div class="modal-content">
                                    <span class="close" id="closeItemsModal{{ $pedido->id }}">&times;</span>
                                    <!-- Conteúdo do modal para exibir itens do pedido -->
                                    <h2 class="h2s">Itens do Pedido #{{ $pedido->id }}</h2>
                                    <div class="table-container">
                                    <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 16px;">
    <tr style="background-color: #f0f0f0; text-align: left;">
        <th style="padding: 10px; border: 1px solid #ddd;">Produto</th>
        <th style="padding: 10px; border: 1px solid #ddd;">Descrição</th>
        <th style="padding: 10px; border: 1px solid #ddd;">Quantidade</th>
        <th style="padding: 10px; border: 1px solid #ddd;">Prazo</th>
    </tr>
    @foreach ($pedido->itens as $item)
    <tr class="trh" style="text-align: left;">
        <td style="padding: 10px; border: 1px solid #ddd;">{{strtoupper($item->produto_id) }}</td>
        <td style="padding: 10px; border: 1px solid #ddd;">{{ strtoupper($item->descricao) }}</td>
        <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->qtd_item }}</td>
        <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->prazo }}</td>
    </tr>
    @endforeach
</table>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>

     <!-- Modal de Ajuda -->
  <div id="ajudaModal" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharAjuda">&times;</span>
        <h2 style="font-weight: bold; font-size: 18px;">Minhas Cotações</h2>
        <br>
        <p>1. Certifique-se de abrir um pedido, na aba "PEDIDO". </p>
        <br>
        <p>2. Aqui será mostrado todos os seus pedidos em aberto.</p>
        <br>
        <p>3. É possível visualizar ou excluir o pedido.</p>
      
    </div>
</div>
</x-app-layout>

<!-- JavaScript  -->
<script>
    // JavaScript 

    document.addEventListener('DOMContentLoaded', function () {
        // Seletor para o botão de pesquisa
        var buscarBtn = document.getElementById('buscar-btn');
        buscarBtn.addEventListener('click', function () {
            var input = document.getElementById('descricao').value.trim().toLowerCase(); // Remova espaços em branco e converta para minúsculas

            var tables = document.querySelectorAll('table.a');

            tables.forEach(function (table) {
                var rows = table.querySelectorAll('tr');
                var headerRow = rows[0];
                var dataRows = Array.from(rows).slice(1);

                dataRows.forEach(function (dataRow) {
                    var cells = dataRow.querySelectorAll('td');
                    var foundInRow = false;

                    // Verifique se o ID do pedido corresponde à pesquisa (ignorando maiúsculas/minúsculas)
                    cells.forEach(function (cell, index) {
                        if (index === 0) { // A primeira célula contém o ID do pedido
                            var cellData = cell.textContent.trim().toLowerCase();
                            if (cellData.includes(input) || input === '') {
                                foundInRow = true;
                            }
                        }
                    });

                    if (foundInRow) {
                        dataRow.style.display = 'table-row'; // Exibe a linha do pedido correspondente
                    } else {
                        dataRow.style.display = 'none'; // Oculta as linhas que não correspondem à pesquisa
                    }
                });

                // Exibe ou oculta o cabeçalho da tabela com base nos resultados da pesquisa
                var isTableEmpty = dataRows.every(function (dataRow) {
                    return dataRow.style.display === 'none';
                });

                if (isTableEmpty) {
                    table.style.display = 'none'; // Oculta a tabela se não houver resultados
                } else {
                    table.style.display = 'table'; // Exibe a tabela se houver resultados
                }
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        // ...

        // Seletor para todos os botões "Visualizar Itens"
        var viewItemsButtons = document.querySelectorAll('.view-items-button');

        // manipulador de eventos de clique a cada botão "Visualizar Itens"
        viewItemsButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Obtenha o ID único do pedido associado a este botão "Visualizar Itens"
                var pedidoId = button.getAttribute('data-id');

                // modal correspondente aos itens do pedido com base no ID
                var itemsModal = document.getElementById('itemsModal' + pedidoId);
                itemsModal.style.display = 'block';

     
            });
        });

        // ...
    });


    document.addEventListener('DOMContentLoaded', function () {
        // ...

        // Seletor para todos os botões de edição
        var editButtons = document.querySelectorAll('.edit-button');

        //manipulador de eventos de clique a cada botão de edição
        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // ID único do pedido associado a este botão de edição
                var pedidoId = button.getAttribute('data-id');

                // Abra o modal correspondente ao pedido com base no ID
                var modal = document.getElementById('myModal' + pedidoId);
                modal.style.display = 'block';

              
            });
        });

        // ...

    });
// fechar o modal quando o botão "X" é clicado
document.addEventListener('DOMContentLoaded', function () {
    // Seletor para todos os elementos de fechamento do modal
    var closeButtons = document.querySelectorAll('.close');

    // Adicione um manipulador de eventos de clique a cada elemento de fechamento do modal
    closeButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Obtenha o modal pai do botão clicado
            var modal = button.closest('.modal');

            // Feche o modal definindo a propriedade 'display' como 'none'
            modal.style.display = 'none';
        });
    });
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
</script>