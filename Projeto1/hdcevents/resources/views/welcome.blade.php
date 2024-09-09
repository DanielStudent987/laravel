<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        {{--CRIANDO ESSES ARQUIVOS NA PASTA PUBLIC PODEMOS CHEGAR NELES ASSIM--}}
        <link rel="stylesheet" href="\css\style.css">
        <script src="\js\script.js"></script>

    </head>
    <body>
       <h1>Home</h1>
       <a href="/contato">ir para contato</a>

       <!--Condicional Inline-->
        @if(10>5) 
        <p>True</p>
        @elseif(10<=5)
        <p>Nao sei<p>
        @else
        <p>False</p>
        @endif
        <p>{{ $nome }}</p>

        {{--ESTRUTURA FOR--}}
        @for($i = 0; $i < count($arr); $i++)
            <p>{{ $arr[$i] }}</p>
        @endfor

        @foreach($names as $name)
            <p>{{ $loop->index }}</p>
            <p>{{ $name }}</p>
        @endforeach

        
    </body>
</html>
