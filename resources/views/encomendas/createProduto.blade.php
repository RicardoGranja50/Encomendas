@extends('layout')
@section('titulo')

@endsection
@section('conteudo')
    <h3 style="font-family:Noto Sans"> Adicionar Produto</h3><br>
    <form action="{{route('encomendas.store.produto', ['id'=>$encomenda])}}" enctype="multipart/form-data" method="post">
        @csrf
            <div class="container-fluid">
                Produto
                <select name="id_produto">
                    @foreach($produtos as $produto)
                        <option value="{{$produto->id_produto}}">{{$produto->designacao}}</option>
                    @endforeach
                </select>
                <br><br>

                Preço: <input type="text" name="preco" value="{{old('preco')}}"><br><br>
                @if($errors->has('preco'))
                    <b style="color:red">Insira um preço</b><br>
                @endif

                Quantidade: <input type="text" name="quantidade" value="{{old('quantidade')}}"><br><br>
                @if($errors->has('quantidade'))
                    <b style="color:red">Insira uma quantidade</b><br>
                @endif
                <input type="submit" value="Adicionar Produto" class="btn btn-primary">
            </div>
    </form>
@endsection