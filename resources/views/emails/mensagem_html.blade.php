<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Seus estilos CSS aqui -->
</head>
<body>
    <div class="container">
        <header style="background-color: #333333; padding: 10px; text-align: center;">
            <h2 style="color: #fff; margin: 0;">Cotação de Produtos</h2>
        </header>
        <div style="padding: 20px;">
            <h1>{{ $assunto }}</h1>

            {!! $mensagem !!}

            <!-- Botão de Ação -->
            <a href="http://netside.ddns.net/" style="display: inline-block; background-color: #333333; color: #fff; padding: 10px 20px; text-decoration: none; margin-top: 20px;">Ver Mais Detalhes</a>
        </div>
        <footer style="background-color: #333333; padding: 10px; text-align: center; color: #fff;">
            &copy; EMP 2023 - Todos os direitos reservados
        </footer>
    </div>
</body>
</html>
