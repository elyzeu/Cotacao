<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/netside.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@700&display=swap" rel="stylesheet">
    <title>Cotação NETSide</title>
    <style>
        body {
           
            color: #ffffff;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
          
          background-color: #333333;
            background-size: 100%;
            
        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            padding: 20px;
        }

        .btnlogin{
            display: inline-block;
            padding: 10px 15px; /* padding que torna os botões menores */
            margin: 10px 5px; /*margem que separa os botões */
            background-color: #6dc900;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            animation: fadecomp 1s ease-in forwards;
        }
        .btnred{
            display: inline-block;
            padding: 10px 15px; /*padding para tornar os botões menores */
            margin: 10px 5px; /*margem separar os botões */
           background-color: #ed2131;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            animation: fadecomp 1s ease-in forwards;
        }

        .btnred:hover {
          background-color: #a11217;
           
        }
        .btnlogin:hover {
            background-color: #3CB371;
           
        }

        /* css para o logotipo */
        #logo {
            position: absolute;
            top: 2%;
            left: 11%;
            width: 20%;
            height: auto;
            animation: fadecomp 1s ease-in forwards;
        }

        /* css para o campo de texto "cotação" */
        #Cotação {
        
  animation-duration: 1s;
  animation-name: slideintcot;


            position: absolute;
            top: 50%;
            left: 10%;
            width:40%;
            max-width: 40%;
            padding: 10px;
            font-size: 22px;
            text-align: justify;
            font-family: Rajdhani;
            transform: translateY(-50%);
            color: white;
        }
        @keyframes slideintcot {
  from {
    margin-left: 10%;
    width: 100%;
  }

  to {
    margin-left: 0%;
    width: 50%;
  }
}


        /* css para os botões Contato e Produtos */
        .btn-container {
            position: absolute;
            top: 75%; /* Ajustar margem sup */
            left: 10%;
            width: 80%;
            max-width: 50%;
            text-align: left; /* Alinha botões esquerda */
        }

        .btn-container .btn {
            width: auto; /* Largura auto  */
            margin: 5px; /* margem separar os botões */
        }

        /* Estilos para os botões de login e registro */
        .auth-buttons {
            position: absolute;
            top: 10px;
            right: 10px;
        }

/*animação botoes */
.ctt {
  animation-duration: 1s;
  animation-name: slideints;
}

@keyframes slideints {
  from {
    margin-left: 5%;
    width: auto;
  }

  to {
    margin-left: 0%;
    width: auto;
    padding: 10px 15px;
  }
}

/* animação texto */
h2 {
  animation-duration: 1s;
  animation-name: slideinto;
}

@keyframes slideinto {
  from {
    margin-left: 30%;
    width: 50%;
  }

  to {
    margin-left: 0%;
    width: 100%;
  }
}
footer {
  height: 7%;
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #222;
  color: #fff;
  text-align: center;
  display: flex;
  justify-content: center; /* Alinhar horizontal no centro */
  align-items: center; /* Alinhamento verfical no centro */
  animation: fadecomp 1s ease-in forwards;
}
#store {
    position: absolute;
    top: 50%; /* Margem do topo*/
    right: 0; /* margem a direita */
    width: 40%; /* Largura padrão para dispositivos maiores */
    height: auto; /* Manter a proporção da imagem */
    transform: translateY(-50%);
    opacity: 0; /* Comece com 0% de intensidade */
    animation: fadeIn 2s ease-in forwards; /* Animação de aparecimento com 2 segundos */
}




@keyframes fadeIn {
    from {
        opacity: 0; /* Inicia com 0% de intensidade */
    }
    to {
        opacity: 0.5; /* Termine com 0.5 de intensidade */
    }
}
@keyframes fadecomp {
    from {
        opacity: 0; /* Inicia com 0% de intensidade */
    }
    to {
        opacity: 1; /* Termina com 100% de intensidade */
    }
}

/* Quando a largura da tela for menor que 1300px   */
@media (max-width: 1300px) {
    #store {
        width: 60%; /* Largura total da tela para dispositivos  celulares */
    
      }
      #Cotação{
        left: 0;
        width: 50%;
        text-align: justify;
        font-size: 12px;
      }
     
      #logo{
    
        width: 40%;
        left: 0;
      }
      .auth-buttons{
        position: absolute;
            top: 10px;
            right: 0;
      }
      /* css para os botões Contato e Produtos */
      .btn-container {
        max-width: 100%;
            position: absolute;
            top: 75%; /* Ajustar margem sup */
            left: 5%;
            width: 100%;
            text-align: left; /* Alinha botões esquerda */
        }
        .btnred{
            display: inline-block;
            padding: 10px 15px; /*padding para tornar os botões menores */
            margin: 10px 5px; /*margem separar os botões */
           background-color: #ed2131;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            
        }
        .ctt {
  animation-duration: 0s;
  animation-name: slideints;
}


}
    </style>
</head>
<body>
    <!-- Logotipo -->
    <img id="logo" src="{{ asset('images/logo.png') }}" alt="Logo da NETSide">
    <img id="store" src="{{ asset('images/img-banner-1.png') }}" alt="store">
    
    <!-- Texto "Cotação" -->
    <div id="Cotação">
        <h2>Cotação</h2>
        <p>Processo de solicitar e receber cotações de preços de produtos de 
          fornecedores.</p>
          <p>A seleção ocorre para quem oferecer o menor valor para determinado item.</p>
        
    </div>
    
    <!-- Botões Contato e Produtos -->
    <div class="btn-container">
        <a  href="http://nside.com.br/contato/" class="btnred ctt">Contato</a>
        <a  href="http://nside.com.br/produtos/" class="btnred pr">Produtos</a>
        <a href="{{ route('download.apk') }}" class="btnred download">Download App</a>
    </div>

    <!-- Botões de Login e Registro -->
    <div class="auth-buttons">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btnred">Ínicio</a>
            @else
                <a href="{{ route('login') }}" class="btnlogin">Entrar</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btnred">Registrar</a>
                @endif
            @endauth
        @endif
    </div>
    
    <footer>
    &copy; {{ date('Y') }} NETSide. Todos os direitos reservados.
</footer>

</div>
</body>
<div>
      
</html>
