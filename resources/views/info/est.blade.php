<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .btnred{
            display: inline-block;
            padding: 10px 15px; /*diminui o padding para tornar os botões menores */
            margin: 10px 5px; /*margem para separar os botões */
           /* border: 2px solid #000000;*/
           
           background-color: #ed2131;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            animation: fadecomp 1s ease-in forwards;
        }

        .btnred:hover {
          background-color: #a11217;
            /*border: 2px solid #a11217;*/
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Est</title>
</head>
<body>
    <h2 class="font-semibold text-xl text-black leading-tight">
        Estrela
    </h2>
    
    <form action="{{ route('atrserach') }}" method="post">
        @csrf
        <div class="flex items-center justify-end mt-4">
            <button id="openModalButton" class="btnincluir ml-4 text-white btnred">
                Estrela
            </button>
        </div>
    </form>
    
</body>
</html>
