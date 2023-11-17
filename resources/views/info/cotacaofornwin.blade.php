<x-app-layout>
    <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    var userData = @json($users);

  
            function mascara_numero(i){
   
   var v = i.value;
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
   }
   
   i.setAttribute("maxlength", "15");

}
</script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <style>
            .h2s {
                font-size: 24px;
                color: #333;
                background-color: #f0f0f0;
                padding: 10px;
                border-radius: 5px;
                text-align: center;
                margin: 0;
            }

            /* Estilos para a janela modal */
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: auto;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fff;
                margin: 15% auto;
                padding: 20px;
                border: 2px solid #333333;
                width: 80%;
                max-width: 100%;
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


            /* CSS for the table */
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

            .th1{
                padding: 1px;
                width: 10%;
                text-decoration-color: black;
                animation-direction: alternate-reverse;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                text-align: right;
                
            }
            .th2{
                padding: 1px;
                width: 10%;
                text-decoration-color: black;
                animation-direction: alternate-reverse;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                text-align: left;
                
            }

            .td11 {
    border-collapse: collapse;
    padding: 10px;
    width: auto;
    text-decoration-color: black;
    animation-direction: alternate-reverse;
    font-family: 'Montserrat', sans-serif;
    font-size: 16px;
    text-align: left;
    border-right: 1px solid black;
    border-bottom: 1px solid black;
    margin-bottom: 10px; 
}


            .td11:hover{
                background-color: #D6EEEE;
            }

            .icoalign {
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

            .table-container {
                max-height: 300px;
                overflow-y: auto;
            }
            .thtx{
                text-align: left;
                border-right: 1px solid black;
    border-bottom: 1px solid black;
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

        @media (max-width: 768px) {
      
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: auto;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fff;
                margin: 15% auto;
                padding: 20px;
                border: 2px solid #333333;
                width: auto;
                
                position: relative;
                overflow: auto;
            }

   /* Estilos para o botão de fechar */
   .close {
                color: #aaa;
                position: relative;
                top: 10px;
                right: 0;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
            }
            .aux{
                width: 40%;
            }
            .btnincluir {
                display: inline-block;
                padding: 5px 10px;
                margin: 10px 5px;
                background-color: #6dc900;
                color: #ffffff;
                text-decoration: none;
                font-weight: bold;
                border-radius: 5px;
                font-size:12px;
                font-family: 'Montserrat', sans-serif;
            }

            .btnincluir:hover {
                background-color: #098F14;
            }
            #buscar-btn {
                display: inline-block;
                padding: 5px 10px;
                margin-left: 3px;
                background-color: #6dc900;
                color: #ffffff;
                border-radius: 5px;
                font-family: 'Montserrat', sans-serif;
                font-size: 12px;
                cursor: pointer;
            }

            #buscar-btn:hover {
                background-color: #098F14;
            }
            .search-label {
                font-family: 'Montserrat', sans-serif;
                font-size: 12px;
                color: #000;
                margin-left: 1px;
            }
}
        </style>
    </head>
    @can('Fornecedor')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Minhas Encomendas') }}
        </h2>
        @if($pedidosAgrupados->isEmpty())
        @else
            <div class="search-container">
                <label class="search-label" for="descricao">{{ __('Buscar') }}</label>
                <input id="descricao" class="aux" oninput="mascara_numero(this)" placeholder="Insira o ID do Pedido" type="text" name="descricao" />
                <button id="buscar-btn" class="btnincluir ml-4 text-white">
                    {{ __('Pesquisar') }}
                </button>
                <button id="mostrar-todos-btn" class="btnincluir ml-4 text-white">
                    {{ __('Mostrar Todos') }}
                </button>
                <button class="help-button" onclick="mostrarAjuda()">?</button>
            </div>
        @endif
    </x-slot>
  
.
    <body>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-10 lg:px-2">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-gray-200">
                   <!-- Crie a tabela principal -->
<!-- Tabela Principal -->
<table class="a">
    <tr data-type="header">
        <th class="th2">ID Pedido</th>
        <th class="th1">Status</th>

        <th class="th1">Excluir</th> 
        <th class="th1">Visualizar Itens</th>
        
    </tr>
   
    @foreach($pedidosAgrupados as $pedido_id => $grupoPedidos)
        <tr class="trh">
            
            <td>
            <span style="font-weight: bold; color: #ff8800; font-size: 16px;">
    # {{ number_format($pedido_id, 0) }}
</span>

            </td>
            <td class="editbtn icoalign">
              
            <button class="edit-button" data-id="{{ $pedido_id }}">
                <i class="fas fa-pencil-alt"></i>
            </button>
        
    </td>
            <td class="editbtn icoalign">
            <form action="{{ route('DeleteMinhaEncomenda', $pedido_id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="delete-button">
        <i class="fas fa-trash"></i>
    </button>
</form>

            
            <td class="editbtn icoalign">
                @if(count($grupoPedidos) > 0)
                    <button class="view-items-button" data-pedidoid="{{ $pedido_id }}">
                        &#x1F4E6;
                    </button>
                @endif
            </td>
          

           
        </tr>

        <!-- Modal HTML-->
<div id="myModal{{ $pedido_id }}" class="modal">
                                <div class="modal-content">
                                    <span class="close" id="closeModal{{ $pedido_id }}">&times;</span>
                                    <form
                                        action="{{ route('DefinirEntregue', $pedido_id) }}"
                                        method="get">
                                        @csrf
                                        <!-- Adicione aqui os campos do formulário -->
                                        <div class="mt-4">
                                            <x-label for="tipo" value="{{ __('Status Pedido') }}" />
                                            <select name="tipo" id="tipo{{ $pedido_id }}">
                                                <option value="1">&#x1F197;Entregue</option>
                                            </select>
                                        </div>
                                        <!-- Outros campos do formulário -->
                                        <!-- Botão para enviar o formulário -->
                                        <div class="flex items-center justify-end mt-4">
                                            <x-button id="openModalButton{{ $pedido_id }}"
                                                class="btnincluir ml-4 text-white btnred">
                                                {{ __('Salvar') }}
                                            </x-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Fim do modal HTML -->
    @endforeach
    
</table>
                    </div>
                </div>
            </div>
        </div>
    </body>

<!-- Adicione o modal à sua página -->
<div class="modal" id="modal">
    <div class="modal-content">
        <span class="close" id="close-modal">&times;</span>
        <h2 style="font-weight: bold; color: #ff8800; font-size: 16px;">Itens do Pedido </h2>
        <br>
        <table>
            <thead>
                <tr>
                    <th class="thtx">Nome</th>
                    <th class="thtx">Quantidade</th>
                    <th class="thtx">Embalagem</th>
                    <th class="thtx">Data de Entrega</th>
                    <th class="thtx">Valor</th>
                    <th class="thtx">Nome do Comprador</th>
                    <th class="thtx">Endereço</th>
                </tr>
            </thead>
            <tbody id="item-list">
                <!-- Aqui serão exibidos os itens do pedido -->
            </tbody>
        </table>
    </div>
</div>
  <!-- Modal de Ajuda -->
  <div id="ajudaModal" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharAjuda">&times;</span>
        <h2 style="font-weight: bold; font-size: 18px;">Encomendas</h2>
        <br>
        <p>1. Quando o comprador define o ganhador de cada cotação...</p>
        <br>
        <p>2. As encomendas serão mostradas aqui.</p>
        <br>
        <p>3. Quando o pedido for entregue, Defina o status da encomenda para entregue...</p>
        <br>
        <p>4. Isso evita acumulo de itens na sua visualização...</p>
        <br>
        <p>5. Caso não for entregar, notifique o Comprador e delete a encomenda</p>
      
    </div>
</div>


@endcan

</x-app-layout>
<!-- JavaScript -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var viewItemsButtons = document.querySelectorAll('.view-items-button');
    var modal = document.getElementById('modal');
    var closeModal = document.getElementById('close-modal');
    var itemList = document.getElementById('item-list');

    viewItemsButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var pedidoId = button.getAttribute('data-pedidoid');
            var itens = @json($pedidosAgrupados);

            // Limpe o conteúdo atual da lista de itens
            itemList.innerHTML = '';

            // Encontre os produtos com o pedido_id correspondente
            if (itens[pedidoId]) {
                itens[pedidoId].forEach(function (pedido) {
                    var row = document.createElement('tr');
                    row.innerHTML = `
                    <td class="td11" style="text-transform: uppercase;">${pedido.nomeproduto}</td>
                        <td class="td11">${pedido.quantidade}</td>
                        <td class="td11" style="text-transform: uppercase;">${pedido.desc}</td>
                        <td class="td11">${pedido.data_entrega}</td>
                        <td class="td11">$${pedido.valor.toFixed(2) }</td>
                        <td class="td11" style="text-transform: uppercase;">${getUserById(pedido.user_id)}</td>
                        <td class="td11" style="text-transform: uppercase;">${getUserById2(pedido.user_id)}</td>
                        `;
                    itemList.appendChild(row);
                });

                // Exiba o modal
                modal.style.display = 'block';
            }
        });
    });

    closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
    });



    // Função para obter o nome do usuário pelo ID
    function getUserById(userId) {
        var user = userData.find(user => user.id == userId);
        return user ? user.name : 'Usuário não encontrado';
    }
    function getUserById2(userId) {
        var user = userData.find(user => user.id == userId);
        return user ? user.endereco : 'Sem Endereço';
    }
});

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


    $(document).ready(function () {
        var showAllButton = $('#mostrar-todos-btn');

    showAllButton.on('click', function () {
        window.location.href = '{{ route('listencomenda') }}';
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





    // Botão de edição de itens
    document.addEventListener('DOMContentLoaded', function () {
        // ...

        // Seletor para todos os botões de edição
        var editButtons = document.querySelectorAll('.edit-button');

        // Adicione um manipulador de eventos de clique a cada botão de edição
        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Obtenha o ID único do pedido associado a este botão de edição
                var pedidoId = button.getAttribute('data-id');

                // Abra o modal correspondente ao pedido com base no ID
                var modal = document.getElementById('myModal' + pedidoId);
                modal.style.display = 'block';

                // Adicione aqui a lógica para preencher o modal com os dados apropriados
            });
        });

        // ...

    });
// JavaScript para fechar o modal quando o botão "X" é clicado
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
</script>




