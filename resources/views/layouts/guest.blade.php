<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        

        <title>Cotação NETSide</title>
        <link rel="icon" href="{{ asset('images/netside.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <style>
             footer {
    background-color: #111;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    
}
        </style>
    </head>
    <body>
        <div class="font-sans text-white antialiased">
   
                {{ $slot }}
       
        <div>
        <footer>
    &copy; {{ date('Y') }} NETSide. Todos os direitos reservados.
</footer>

</div>
        @livewireScripts
    </body>
</html>
