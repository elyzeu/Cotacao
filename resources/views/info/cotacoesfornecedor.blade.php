<x-app-layout>

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

        <style>


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


          
            th,
            td {
                padding: 5px;
                text-decoration-color: black;
                animation-direction: alternate-reverse;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                text-align: left;

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

            .Align {
                text-align: justify;
            }

            .editbtn {
                background-color: #FFEFD5;
                width: 1px;

                align: left;

            }

            .editbtn:hover {
                background-color: #FFE4B5;
            }

            /* Adicione estilos CSS para a tabela de itens do pedido */
table.item-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    border: 1px solid #ddd;
}

table.item-table th {
    background-color: #f2f2f2;
    padding: 10px;
    text-align: left;
}

table.item-table td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
 
}



table.item-table tr:hover {
    background-color: #D6EEEE;
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
@can('Fornecedor')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Minhas Cotações') }}
        </h2>
        <div class="search-container">
               
                <button class="help-button" onclick="mostrarAjuda()">?</button>
            </div>
   
    </x-slot>

    <body>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-10 lg:px-12">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                @if(session('error'))
                <div class="alert alert-danger" style="text-align: center; background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: 10px; border-radius: 5px;">
    {{ session('error') }}
</div>

@endif
                    <div>
                        @foreach($todosPedidos as $pedido)
                        <div style="overflow-x:auto;">  
                            <x-validation-errors class="mb-4" />

                            <table class="a">
                                <tr data-type="header">
                                    <th>ID Pedido</th>
                                    <th for="nome">Status</th>
                                </tr>
                                <tr class="trh">
                                    <td>
                                       
                                        <span style="font-weight: bold; color: #ff8800; font-size: 16px;"># {{ $pedido->id }}</span>
                                    </td>
                                    @if($pedido->status == 1)
                                        <td>&#x1F197;Ativo</td>
                                    @else
                                        <td>&#x1F512;Encerrado</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <table class="item-table">
                                            <tr>
                                                <th>Nome do Item</th>
                                                <th>Quantidade</th>
                                                <th>Embalagem</th>
                                                <th>Prazo</th>
                                                <th class="Align th">Inserir Valor</th>
                                            </tr>
                                            @foreach($todosItens[$pedido->id] as $item)
                                                <tr>
                                                    <td> &#x1F4E6;{{ strtoupper($item->produto_id) }}</td>
                                                    <td>&#x1F9FE;{{ $item->qtd_item }}</td>
                                                    <td>&#128441;{{ strtoupper($item->descricao) }}</td>
                                                    <td>&#x1F4C5;{{ $item->prazo }}</td>
                                                    <td class="editbtn">
                                                        <!-- Adicione o atributo data-produto-id com o valor correto do produto_id -->
                                                        <button data-id_item="{{ $item->id }}" class="edit-button" data-id="{{ $pedido->id }}" data-produto-id="{{ $item->produto_id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                                <!-- Modal HTML  -->
                                <div id="myModal{{ $pedido->id }}" class="modal">
                                    <div class="modal-content">
                                        <span class="close" id="closeModal{{ $pedido->id }}">&times;</span>
                                        <form
                                            action="{{ route('AddValorCotacao', ['id' => $pedido->id, 'user_id' => $pedido->user_id]) }}"
                                            method="get">
                                            @csrf
                                            <div class="mt-4">
                                                <x-label for="valor" value="{{ __('Valor Da Cotação') }}" />
                                                <x-input id="valor" class="block mt-1 w-full" type="number" name="valor"
                                                    :value="old('valor')" required autocomplete="valor" />
                                            </div>
                                            <!-- Adicione um campo oculto para armazenar o produto_id -->
                                          <input type="hidden" id="produto_id{{ $pedido->id }}" name="produto_id" value="">
                                          <input type="hidden" id="item_id{{ $pedido->id }}" name="item_id" value="">

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
                            </table>
                            

                            <hr style="width: 100%; height: 10px; background-color: black; border: none;">
    </div>
                        @endforeach
                    </div>
                </div>
                {{ $todosPedidos->links() }}
            </div>
        </div>
    </body>

     <!-- Modal de Ajuda -->
  <div id="ajudaModal" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharAjuda">&times;</span>
        <h2 style="font-weight: bold; font-size: 18px;">Cotações</h2>
        <br>
        <p>1. Aqui é mostrado as cotações que estão em aberto...</p>
        <br>
        <p>2. Não é encomenda ainda. Você, pode dar valor a cada item...</p>
        <br>
        <p>3. O menor valor na concorrência será o ganhador da encomenda...</p>
       
      
    </div>
</div>
</x-app-layout>
@endcan
<!-- JavaScript-->
<script>
   
    document.addEventListener('DOMContentLoaded', function () {
    // Seletor para todos os botões de edição
var editButtons = document.querySelectorAll('.edit-button');

// Adicione um manipulador de eventos de clique a cada botão de edição
editButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        // Obtenha o ID único do pedido associado a este botão de edição
        var pedidoId = button.getAttribute('data-id');

        // Obtenha o produto_id associado a este botão de edição
        var produtoId = button.getAttribute('data-produto-id');

        // Obtenha o item_id associado a este botão de edição
        var itemId = button.getAttribute('data-id_item');

        // Defina o valor dos campos ocultos produto_id e item_id
        var produtoIdInput = document.getElementById('produto_id' + pedidoId);
        var itemIdInput = document.getElementById('item_id' + pedidoId);
        produtoIdInput.value = produtoId;
        itemIdInput.value = itemId;

        // Abra o modal correspondente ao pedido com base no ID
        var modal = document.getElementById('myModal' + pedidoId);
        modal.style.display = 'block';

        // Adicione aqui a lógica para preencher o modal com os dados apropriados
    });
});

        // Adicione um manipulador de eventos de clique para o botão "x" de cada modal
        var closeButtons = document.querySelectorAll('.close');
        closeButtons.forEach(function (closeButton) {
            closeButton.addEventListener('click', function () {
                // Obtenha o ID exclusivo do modal a ser fechado
                var modalId = closeButton.getAttribute('id').replace('closeModal', '');

                // Feche o modal correspondente
                var modal = document.getElementById('myModal' + modalId);
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