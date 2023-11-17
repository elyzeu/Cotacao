    <x-app-layout>

        <head>
        
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&display=swap" rel="stylesheet">
            <style>
                /* css para tabela */
                .search-container {
                    display: flex;
                    align-items: center;
                    justify-content: flex-end;
                    margin-top: 1rem;
                }
                .trh:hover {
                background-color: #D6EEEE;
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



                /* tabela */
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

                /* codigo pro modal */
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

                /* botão de fechar */
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
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Produtos') }}
        </h2>
        @if($produtos->isEmpty())
        
        @else
            <div class="search-container">
                <label class="search-label" for="descricao">{{ __('Buscar') }}</label>
                <input id="descricao" placeholder="Nome ou Cod barra" type="text" name="descricao" />
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
    
    <body>
        <x-button id="openModalButton" class="btnincluir ml-4 text-white">
            {{ __('Incluir +') }}
        </x-button>
    
        <div class="py-12">
            <div class="bg-gray-200">
                <x-validation-errors class="mb-4" />
    
                <div style="overflow-x:auto;">
                    <table class="a">
                        <thead>
                            <tr>
                                <th for="codigo" style="width: 10%;">Código</th>
                                <th for="descricao" style="width: 60%;">Produto</th>
                                <th for="codigobarra" style="width: 30%;">Código de Barras</th>
                            </tr>
                        </thead>
                        <tbody id="produtos-table-body">
                           
                            @foreach($produtos as $produto)
                                <tr class="trh">
                                    <td>{{ $produto->id }}</td>
                                    <td>{{ $produto->nompro }}</td>
                                    <td>{{ $produto->codpro }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
                <div class="pagination">
                    {{-- Paginação será exibida aqui --}}
                    {{ $produtos->links() }}
                </div>
            </div>
        </div>
    </body>
</x-app-layout>

<!-- modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <!-- Botão "x" para fechar no canto superior direito -->
        <span class="close" id="closeModal">&times;</span>
    
        <!-- Conteúdo da janela modal form de cad de produto) -->
        <form method="POST" action="{{ route('ProdutoStore') }}">
            @csrf
            <!-- campos do formulário -->
    
            <x-label for="descricao" value="{{ __('descricao') }}" />
            <x-input id="descricao" placeholder="descricao" type="text" name="descricao" required
                autocomplete="funcionario" />
            <x-label for="codpro" value="{{ __('codpro') }}" />
            <x-input id="codpro" placeholder="codpro" type="text" name="codpro" required
                autocomplete="codpro" />
    
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
        <h2 style="font-weight: bold; font-size: 18px;">Produtos</h2>
        <br>
        <p>1. Aqui é mostrado todos os produtos existente no banco de dados...</p>
        <br>
        <p>2. Você pode pesquisar pelo código de barra ou pelo nome</p>
       
    </div>
</div>


<!-- js pra mostrar ou nao a janela modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    var searchButton = $('#buscar-btn');
    var showAllButton = $('#mostrar-todos-btn');
    var produtosTableBody = $('#produtos-table-body');
    var modal = $('#myModal');
    var closeModalButton = $('#closeModal');
    var currentPage = 1; // Página atual

    searchButton.on('click', function () {
        var input = $('#descricao').val().toLowerCase();
        $.ajax({
            url: '{{ route('produto.search') }}',
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
                search: input
            },
            success: function (data) {
                exibirProdutos(data.data); // Exibir apenas os dados
                currentPage = data.current_page; // Atualizar a página atual
            },
            error: function (xhr, textStatus, errorThrown) {
                // Lida com erros, se necessário
            }
        });
    });

    showAllButton.on('click', function () {
        window.location.href = '{{ route('Produtos') }}';
    });

    function exibirProdutos(data) {
        produtosTableBody.empty();
        data.forEach(function (produto) {
            var row = `
                <tr>
                    <td>${produto.id}</td>
                    <td>${produto.nompro}</td>
                    <td>${produto.codpro}</td>
                </tr>
            `;
            produtosTableBody.append(row);
        });
    }

    // Função para abrir o modal
    $('#openModalButton').on('click', function () {
        modal.css('display', 'block');
    });

    // Função para fechar o modal
    closeModalButton.on('click', function () {
        modal.css('display', 'none');
    });

    $(window).on('click', function (event) {
        if (event.target == modal[0]) {
            modal.css('display', 'none');
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
