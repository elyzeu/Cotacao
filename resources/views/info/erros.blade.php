<x-app-layout>

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

     
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Painel de Controle') }}
        </h2>
      
    </x-slot>
    @if(session('error'))
                <div class="alert alert-danger" style="text-align: center; background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: 10px; border-radius: 5px;">
   
                {{ session('error') }}
</div>

@endif
@can('Comprador')
@if($mensagem)
                <div class="alert alert-danger" style="text-align: center; background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: 10px; border-radius: 5px;">
    {{ $mensagem}}
</div>

@endif
@endcan
@can('Fornecedor')

<div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
      
              

                <!-- Janela para exibir alguma parada -->
                <div class="data-window">
                    <h3></h3>
                    <div class="data-content">
                        @can('Fornecedor')
                        <ul>
                            <li>Peça o comprador para te cadastrar</li>
                            <li>para que haja pedidos em aberto para você</li>
                            <li></li>
                        </ul>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    </body>
</x-app-layout>
<style>
            .data-window {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin: 20px auto;
            max-width: 400px;
        }

        .data-window h3 {
            margin-top: 0;
        }
</style>

<!-- Janela modal -->
