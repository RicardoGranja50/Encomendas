@extends('layout')
@section('titulo')

@endsection
@section('conteudo')
    <h3 style="font-family:Noto Sans"> Editar Produto</h3><br>
    <form action="{{route('encomendas.update.produto', ['id'=>$encomenda,'idp'=>$relacao->id_produto])}}" enctype="multipart/form-data" method="post">
        @csrf
            <div class="container-fluid">
                Produto
                <select name="id_produto">
                    @foreach($produtos as $produto)
                        <option value="{{$produto->id_produto}}"@if($produto->id_produto==$relacao->id_produto) selected @endif>{{$produto->designacao}}</option>
                    @endforeach
                </select>
                @if($errors->has('id_produto'))
                    <b style="color:red">Insira produto</b><br>
                @endif
                <br><br>

                Preço: <input type="text" name="preco" value="{{$relacao->preco}}"><br><br>
                @if($errors->has('preco'))
                    <b style="color:red">Insira um preço</b><br>
                @endif

                Quantidade: <input type="text" name="quantidade" value="{{$relacao->quantidade}}"><br><br>
                @if($errors->has('quantidade'))
                    <b style="color:red">Insira uma quantidade</b><br>
                @endif
                <input type="submit" value="Editar Produto" class="btn btn-primary">
            </div>
    </form>
@endsection