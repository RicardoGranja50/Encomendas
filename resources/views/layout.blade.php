<!doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        @yield('titulo')
        <style>
            #hover:hover {
                background-color: #cccccc;
            }
        </style>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="navbar-brand" href="{{route('clientes.index')}}" id="hover">Clientes</a>
                    <a class="navbar-brand" href="{{route('encomendas.index')}}" id="hover">Encomendas</a>
                    <a class="navbar-brand" href="{{route('produtos.index')}}" id="hover">Produtos</a>
                    <a class="navbar-brand" href="{{route('vendedores.index')}}" id="hover">Vendedores</a>
                    <a class="navbar-brand" href="{{route('formulario')}}" id="hover">Pesquisa</a>
                </div>
            </div>
        </nav>

        @if(session()->has('verde')) 
            <div class="alert alert-success" role="alert">
                {{session('verde')}}	
            </div>   
        @endif

        @if(session()->has('vermelho')) 
            <div class="alert alert-danger" role="alert">
                {{session('vermelho')}}	
            </div>   
        @endif
    </head>
    <body>
        <h1 style="color: red"> @yield("header")</h1>
        

        
        @yield('conteudo')
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    </body>
</html>