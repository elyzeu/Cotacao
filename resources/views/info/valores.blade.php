<x-app-layout>

    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <style>

            /*  styles para o input de pesquisa e botão */
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
                border-radius: 5px;
            }


            .bg {
                background-color: rgb(196, 252, 237);
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
                margin: 5% auto;
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
            select {
        width: 90%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        align: left;
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
            {{ __('Definir Vencedor') }}
        </h2>
        <div class="search-container">
                
                <button class="help-button" onclick="mostrarAjuda()">?</button>
            </div>
        

    </x-slot>

    <body>
        <div class="py-12">
            
            <div class="max-w-7xl mx-auto sm:px-10 lg:px-12">
                
        <div class="flex items-center justify-end mt-4">
            <button id="enviar-itens-btn" class="btnincluir ml-4 text-white ">
                {{ __('Enviar Pedidos') }}
            </button>
        </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-gray-200">
                    
                            <x-validation-errors class="mb-4" />
                            @foreach($valor->groupBy('pedido_id') as $pedidoId => $pedidos)
    <table class="a">
        <tr data-type="header">
            <th>ID Pedido</th>
            <th for="descricao">Fornecedores e Valores</th>
        </tr>
        <tr class="trh">
            <td>
                
                <span style="font-weight: bold; color: #ff8800; font-size: 16px;"># {{ $pedidoId }}</span>
            </td>
            <td>
                @php
                    // Agrupe os valores por item dentro deste pedido
                    $valoresPorItem = $pedidos->groupBy('pedidoItem_id');
                @endphp

                @foreach($valoresPorItem as $pedidoItem => $valores)
                    @foreach($fornecedor as $fornecedores)
                    @if($valores[0]->fornecedor_id == $fornecedores->idaux )
                    
                        <form method="POST" action="{{ route('FornecedorVencedor') }}" class="form-vencedor-{{ $pedidoId }}" onsubmit="return validateForm(this);">
                            @csrf
                            <div class="input-group">
                                <input type="hidden" name="pedidoitem_id" value="{{ $valores[0]->pedidoitem_id }}">
                                @php
                                    // Classifique os valores em ordem crescente com base no campo 'valor'
                                    $valores = $valores->sortBy('valor');
                                    @endphp
                                @foreach($valores->groupBy('pedidoitem_id') as $pedidoItemId => $valoresPorItem)
    <select  name="cars" id="cars_{{ $pedidoItemId }}" >
    <option value="">Selecione o Vencedor</option>
        <!-- Exibe o item e seus valores no select -->
        @foreach($valoresPorItem as $val)
     
            <option  data-valor="{{$val->valor}}"   value="{{ $val->pedido_id }}"
            data-qtd_item="{{ $val->pedidoItem->qtd_item}}"
            data-prazo="{{ $valores[0]->pedidoItem->prazo }}"
            data-pedido_id="{{ $pedidoId }}"
            data-email="{{ $val->fornecedor->email }}"
            data-id_fornecedor="{{ $val->fornecedor->idaux }}"
            data-produto="{{ $val->nompro }}"
            data-desc="{{$val->pedidoItem->descricao}}"
            >PRODUTO: {{ strtoupper($val->nompro) }} - Embalagem - {{strtoupper($val->pedidoItem->descricao)}} -
             VALOR: {{ $val->valor }} - FORNECEDOR: {{ strtoupper($val->fornecedor->funcionario) }} - EMAIL: {{ strtoupper($val->fornecedor->email) }} 
            </option>
        @endforeach
    </select>
                           
    <br> <!-- Adicione uma quebra de linha aqui -->
@endforeach





                               
                            </div>
                            <!-- Adicione campos de entrada ocultos para os dados específicos da opção selecionada -->
                            <input type="hidden" name="valor" class="hidden-valor" value="">
                            <input type="hidden" name="id_fornecedor" class="hidden-id_fornecedor" value="">
                            <input type="hidden" name="email" class="hidden-email" value="">
                            <input type="hidden" name="produto" class="hidden-produto" value="">
                            <input type="hidden" name="qtd_item" class="hidden-qtd_item" value="">
                            <input type="hidden" name="prazo" class="hidden-prazo" value="">
                            <input type="hidden" name="pedido_id" class="hidden-pedido_id" value="">
                            <input type="hidden" name="desc" class="hidden-desc" value="">
                        </form>
                    @endif
                    @endforeach
                @endforeach
            </td>
        </tr>
        <div class="search-container">
   
</div>

    </table>
   
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
        <h2 style="font-weight: bold; font-size: 18px;">Valores em cada Item</h2>
        
        <p>1. Aqui serão mostrados os Pedidos, seus itens e os valores...</p>
       
        <p>2. Os valores são fornecidos pelo fornecedor para cada item...</p>
        
        <p>3. Ao selecionar o fornecedor ganhador de cada item, será enviado um email...</p>
       
        <p>4. Esse email ira conter todos os itens respectivos encomendados por você para aquele fornecedor...</p>
        
        <p>5. Além disso, será mostrado a encomenda em uma página para o fornecedor...</p>
        
        <p>6. EX: Se um pedido tem 2 item, aqui você pode selecionar um fornecedor para cada item...</p>
        
        <p>7. O fornecedor que vender mais barato para você</p>

        <p>8. Caso tenha um atraso após clicar em "Definir Vencedor" aguarde... Os e-mails estão sendo enviados</p>
    </div>
</div>
</x-app-layout>
    <script>

document.addEventListener('DOMContentLoaded', function () {
            // Pega todos os elementos select
            var selectElements = document.querySelectorAll('select[name="cars"]');

            // Adiciona um ouvinte de evento para cada select
            selectElements.forEach(function (selectElement) {
                selectElement.addEventListener('change', function () {
                    // Obtém a opção selecionada
                    var selectedOption = this.options[this.selectedIndex];

                    // Obtém os valores de dados da opção selecionada
                    var valor = selectedOption.getAttribute('data-valor');
                    var pedido_id = selectedOption.getAttribute('data-pedido_id');

                    // Encontra o formulário mais próximo (ancestral) do select
                    var form = this.closest('form');

                    // Encontra os campos hidden dentro do formulário
                    var hiddenValorElement = form.querySelector('.hidden-valor');
                    var hiddenPedidoIdElement = form.querySelector('.hidden-pedido_id');

                    // Atribui os valores aos campos hidden
                    hiddenValorElement.value = valor;
                    hiddenPedidoIdElement.value = pedido_id;

                    // Agora o valor do select deve ser enviado corretamente quando o formulário for submetido
                });
            });
        });




     // Função para criar um novo select quando o pedidoitem_id for diferente
        function criarNovoSelect(pedidoitem_id) {
            var selectContainer = document.querySelector('#select-container-' + pedidoitem_id);

            if (!selectContainer) {
                return;
            }

            var novoSelect = document.createElement('select');
            novoSelect.className = 'form-control';
            novoSelect.name = 'cars';

            // Adicione opções ao novo select aqui com base no pedidoitem_id

            selectContainer.appendChild(novoSelect);
        }

        // Loop através de todos os pedidos para verificar se o pedidoitem_id é diferente e, em seguida, chame a função para criar um novo select
        @foreach($valor->groupBy('pedido_id') as $pedidoId => $pedidos)
            @php
                $currentPedidoItemID = null;
            @endphp

            @foreach($pedidos as $pedido)
                @if ($pedido->pedidoItem_id !== $currentPedidoItemID)
                    criarNovoSelect({{ $pedido->pedidoItem_id }});
                @endif

                @php
                    $currentPedidoItemID = $pedido->pedidoItem_id;
                @endphp
            @endforeach
        @endforeach

        //validação ver se está vazio
        function validateForm(form) {
    // Obtenha o valor do select
    var selectedOption = form.querySelector('select[name="cars"]');
    
    // Verifique se alguma opção foi selecionada
    if (selectedOption.value === "") {
        alert("Por favor, selecione um vencedor antes de enviar o formulário.");
        return false; // Impede o envio do formulário
    }
    
    // Se a validação passar, permita o envio do formulário
    return true;
}

// Função para validar se todos os selects estão preenchidos
function validateForm() {
    var selects = document.querySelectorAll('select[name="cars"]');

    for (var i = 0; i < selects.length; i++) {
        if (selects[i].value === "") {
            alert("Por favor, selecione um vencedor para todos os itens antes de enviar o formulário.");
            return false; // Impede o envio do formulário
        }
    }

    return true; // Todos os selects estão preenchidos, permita o envio do formulário
}


document.addEventListener('DOMContentLoaded', function () {
    // Seletor para o botão "Enviar Itens Selecionados"
    var enviarItensBtn = document.getElementById('enviar-itens-btn');

    enviarItensBtn.addEventListener('click', function () {
        // Crie um array para armazenar os dados dos itens selecionados
        if (validateForm()) {
        var itensSelecionados = [];

        // Seletor para todos os selects com nome "cars"
        var selects = document.querySelectorAll('select[name="cars"]');

        selects.forEach(function (select) {
            // Verifique se uma opção foi selecionada em cada select
            if (select.value !== "") {
                // Obtenha os dados da opção selecionada
                var selectedOption = select.options[select.selectedIndex];
                var valor = selectedOption.getAttribute('data-valor');
                var id_fornecedor = selectedOption.getAttribute('data-id_fornecedor');
                var email = selectedOption.getAttribute('data-email');
                var produto = selectedOption.getAttribute('data-produto');
                var qtd_item = selectedOption.getAttribute('data-qtd_item');
                var prazo = selectedOption.getAttribute('data-prazo');
                var pedido_id = selectedOption.getAttribute('data-pedido_id');
                var desc = selectedOption.getAttribute('data-desc');

                // Crie um objeto para armazenar os dados do item selecionado
                var itemSelecionado = {
                    valor: valor,
                    id_fornecedor: id_fornecedor,
                    email: email,
                    produto: produto,
                    qtd_item: qtd_item,
                    prazo: prazo,
                    pedido_id: pedido_id,
                    desc: desc
                };

                // Adicione o item ao array de itens selecionados
                itensSelecionados.push(itemSelecionado);
            }
        });


        console.log(itensSelecionados);

 
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


        fetch('/storeallitens', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify(itensSelecionados)
})
            .then(response => response.json())
            .then(data => {
                if (data.redirect) {
                    // Redirecionar o usuário para a URL especificada
                    window.location.href = data.redirect;
                } else {
                    // Lidar com outras respostas ou lógica aqui
                }
            })
            .catch(error => {
                console.error('Erro ao enviar dados:', error);
            });
        }
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


