<x-app-layout>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    <style>
   
    table {
        border-collapse: separate;
        border-spacing: 5px;
        width: 100%;
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

    .btnred {
        display: inline-block;
        padding: 10px 15px;
        margin: 10px 5px;
        background-color: #FF3333;
        color: #ffffff;
        text-decoration: none;
        font-weight: bold;
        border-radius: 5px;
    }

    .btnred:hover {
        background-color: #a11217;
    }

    /* Estilo para células <th> */
th {
   width: auto;
    font-family: 'Montserrat', sans-serif;
    font-size: 16px;
    text-align: left;
}

    td {
        padding: 8px;
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
        text-align: left;
    }

    tr {
        border-bottom: 1px solid black;
    }

    td:hover {
        background-color: #D6EEEE;
    }
    
   
    input, select {
        width: auto;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        align: left;
    }

    /* Estilos para botão de adicionar item */
    #addItemButton {
        background-color: #007BFF;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        float: left;
        margin-bottom: 10px;
    }

    #addItemButton:hover{
        background-color: #0056b3;   
    }
    /* Estilos para remover item */
    .removeItemButton {
        background-color: #FF3333;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .removeItemButton:hover {
        background-color: #a11217;
    }

    /* Estilos para o input de pesquisa de produtos */
    .produtoInput {
        position: relative;
        width: 100%;
    }

    .produtoSelect {
        width: 100%; /* Define a largura do select para 100% */
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
            @media (max-width: 768px) {
      
      .produtoSelect {
      width: 200px; /* Define a largura do select para 100% */
  }
  

}
</style>
</head>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-black leading-tight">
        {{ __('Abrir Cotação') }}
    </h2>

    <div class="search-container">
               
    <button class="help-button" onclick="mostrarAjuda()">?</button>
            </div>
</x-slot>



<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-validation-errors class="mb-4" />
            <div style="overflow-x:auto;">  
            <!-- Formulário -->
            <form method="POST" action="{{ route('PedidoStore') }}">
                @csrf


                
                <!-- Container para formulário de adição de item - inicialmente vazio -->
                <div id="addItemFormContainer">
                    <table>
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Embalagem</th>
                                <th>Data de Entrega</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Linhas dos itens serão adicionadas aqui -->
                           
                        </tbody>
                    </table>
                </div>

                <!-- Botão "Salvar" para enviar para a rota -->
                <div class="flex items-center  mt-4">
    <button type="button" id="addItemButton" onclick="adicionarItem()" class="btnincluir btnred mr-4">Adicionar Item</button>
    <x-button id="openModalButton" class="btnincluir btnred text-white">
        {{ __('Salvar') }}
    </x-button>
</div>


            </form>
        </div>
        </div>
    </div>
</div>
</x-app-layout>

 <!-- Modal de Ajuda -->
 <div id="ajudaModal" class="modal">
    <div class="modal-content">
        <span class="close" id="fecharAjuda">&times;</span>
        <h2 style="font-weight: bold; font-size: 18px;">Criar pedido de cotação</h2>
        <br>
        <p>1. Aqui você cria o pedido de cotação...</p>
        <br>
        <p>2. Todos os pedidos aberto por você será exibido para os fornecedores seu...</p>
        <br>
        <p>3. Você pode abrir pedido para um item, ou vários itens.</p>
        
    </div>
</div>
<script>
    // Função para adicionar um novo item à tabela
    function adicionarItem() {
        // Encontre o número de campos já existentes para determinar o próximo índice
        var numRows = document.querySelectorAll('#addItemFormContainer tr').length;

        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <div class="produtoInput">
                    <select name="produto_id[${numRows}]" class="produtoSelect">
                        <option value="">Selecione um produto</option>
                    </select>
                </div>
            </td>
            <td><input type="number" name="quantidades[${numRows}]" placeholder="Quantidade de produtos" required></td>
            <td><input type="text" name="observacoes[${numRows}]" placeholder="Embalagem Un, Fd, Cx, Dp" required></td>
            <td><input type="text" name="datas[${numRows}]" id="data_${numRows}" onblur="mascara_data(this)" placeholder="00/00/0000" required></td>
            <td><button type="button" class="removeItemButton" onclick="removerItem(this)">Remover</button></td>
        `;

        document.querySelector('#addItemFormContainer tbody').appendChild(newRow);

        // Inicializar o Select2 no novo select
        var newSelect = newRow.querySelector('.produtoSelect');
        $(newSelect).select2({
            placeholder: 'Selecione um produto',
            language: {
        inputTooShort: function () {
            return "Digite o nome do produto ou pelo menos um caractere";
             }
            },
            ajax: {
                url: '/buscar-produtos', // Substitua pela URL correta da sua rota de busca
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term,
                        page: params.page
                    };
                },
                processResults: function (data) {
                    var results = data.results.map(function (produto) {
                        return {
                            id: produto.id,
                            text: produto.text // Exibe o nome do produto
                        };
                    });

                    return {
                        results: results,
                        pagination: {
                            more: data.pagination.more
                        }
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });
        var inputElements = document.querySelectorAll('input[id^="data_"]');
    inputElements.forEach(function (inputElement) {
        var inputId = inputElement.id;
        
        $(`#${inputId}`).inputmask('99/99/9999', { 'placeholder': '00/00/0000' });
    });
    }

    function removerItem(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    function mascara_data(input) {
    var valor = input.value;
    if (valor.length === 2) {
        input.value = valor + '/';
    } else if (valor.length === 5) {
        input.value = valor + '/';
    }

    // Validação de data
    if (valor.length === 10) {
        if (!validarData(valor)) {
            alert('Selecione uma data a partir de hoje.');
            input.value = ''; // Limpa o campo se a data for inválida
        }
    }
}

    // Chamar a função para preencher o campo de seleção de produtos ao carregar a página
    $(document).ready(function () {
        var selectElements = document.querySelectorAll('.produtoSelect');
        selectElements.forEach(function (selectElement) {
            preencherProdutos(selectElement);
        });
    });

    // Função para preencher o campo de seleção de produtos com opções
    function preencherProdutos(selectElement) {
        $.ajax({
            url: '/buscar-produtos', // Substitua pela URL correta da sua rota de busca de produtos
            dataType: 'json',
            success: function (data) {
                var options = data.results.map(function (produto) {
                    return {
                        id: produto.id,
                        text: produto.text // Exibe o nome do produto
                    };
                });

                // Defina as opções no select
                $(selectElement).empty().select2({
                    placeholder: 'Selecione um produto',
                    data: options
                });
            }
        });
    }



// Função para validar se a data é maior ou igual à data atual
function validarData(data) {
    var partesData = data.split('/');
    if (partesData.length !== 3) {
        return false; // Formato de data inválido
    }

    var dia = parseInt(partesData[0], 10);
    var mes = parseInt(partesData[1], 10) - 1; // Mês é base 0 (janeiro = 0, fevereiro = 1, etc.)
    var ano = parseInt(partesData[2], 10);

    var dataSelecionada = new Date(ano, mes, dia);
    var dataAtual = new Date();

    // Defina a hora atual para 00:00:00.000
    dataAtual.setHours(0, 0, 0, 0);

    return dataSelecionada >= dataAtual;
}


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
