<x-app-layout>
    <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>

        <style>
            .btndelet {
                display: inline-block;
                padding: 10px 15px;
                margin: 10px 5px;
                background-color: #ed2131;
                color: #ffffff;
                text-decoration: none;
                font-weight: bold;
                border-radius: 5px;
                font-family: 'Montserrat', sans-serif;
            }

            .btndelet:hover {
                background-color: #a11217;
            }

            .text {
                font-size: 22px;
                text-align: center;
                font-family: Montserrat;
                color: black;
            }

            .highlight {
                background-color: #333333;
                color: white;
            }

            /* Estilos para o modal */
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 50%;
                position: relative;
            }

            .modal-content label {
                display: block;
                margin-bottom: 5px;
            }

            .modal-content input {
                width: 100%;
                padding: 5px;
                margin-bottom: 10px;
            }

            .modal-content button {
                background-color: #3498db;
                color: #fff;
                border: none;
                padding: 10px 15px;
                cursor: pointer;
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
            .h2s {
            font-size: 24px;
            color: #333; /* Cor do texto */
            background-color: #f0f0f0; /* Cor de fundo */
            padding: 10px; /* Espaçamento interno */
            border-radius: 5px; /* Cantos arredondados */
            text-align: center; /* Alinhamento de texto no centro */
            margin: 0; /* Remove margens padrão */
        }
        </style>
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liberação') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center min-h-screen">
        <div class="max-w-md w-full space-y-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('LiberacaoUso') }}">
                    @csrf


                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email Do Comprador') }}" />
                        <x-input id="email"  placeholder="email@gmail.com" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>
                    <div class="mt-4">
    <x-label for="status" value="{{ __('Status') }}" />
    <select id="status" name="status" class="block mt-1 w-full" required>
        <option value="0">Bloquear</option>
        <option value="1">Liberar</option>
    </select>
</div>

                  

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4 btnred">
                            {{ __('Liberar') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

 
   
   

    </x-app-layout>
    <script>
        // Função para abrir o modal
        function openModal(id, type) {
            var modal = document.getElementById('modal-' + id + '-' + type);
            modal.style.display = 'block';
        }

        // Função para fechar o modal
        function closeModal(id) {
            var modal = document.getElementById('modal-' + id + '-liberar');
            modal.style.display = 'none';
        }

   // Função para liberar comprovante (adicione a lógica de envio de dados para o servidor)
     function liberarComprovante(id) {
        var dataPagamento = document.getElementById('data_pagamento').value;
        var dataVencimento = document.getElementById('data_vencimento').value;
        var userIdModal = document.getElementById('user_id_modal').value;

        var data = {
            id: id,
            data_pagamento: dataPagamento,
            data_vencimento: dataVencimento,
            user_id: userIdModal
        };

        // Realizar uma solicitação AJAX (ou fetch) para enviar os dados ao servidor
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "{{ route('atualizarpagamento') }}", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // A solicitação foi bem-sucedida, você pode tratar a resposta do servidor aqui
                console.log(xhr.responseText);
                closeModal(id);
            }
        };

        xhr.send(JSON.stringify(data));
    }

//mascara de data
$(document).ready(function() {
    $('#data_pagamento').inputmask('99/99/9999', { 'placeholder': 'dd/mm/yyyy' });
    $('#data_vencimento').inputmask('99/99/9999', { 'placeholder': 'dd/mm/yyyy' });
});
    </script>

