@extends('layout')
@section('titulo')

@endsection
@section('conteudo')
    <form action="{{route('produtos.update', ['id'=>$produto->id_produto])}}"enctype="multipart/form-data" method="post">
        @csrf
        @method('patch')
        
        <div class="container-fluid">
        	Nome Produto: (<b style="color:red">*</b>)<input type="text" name="designacao" value="{{$produto->designacao}}"><br><br>
            @if($errors->has('designacao'))
                <b style="color:red">O nome do produto deve ser entre 3 e 100 caracteres</b><br>
            @endif

            Stock: (<b style="color:red">*</b>)<input type="text" name="stock" value="{{$produto->stock}}"><br><br>
            @if($errors->has('stock'))
                <b style="color:red">Insira um stock valido</b><br>
            @endif

            Preço: (<b style="color:red">*</b>)<input type="text" name="preco" value="{{$produto->preco}}"><br><br>
            @if($errors->has('preco'))
                <b style="color:red">Insira um preço</b><br>
            @endif

           	Observaçoes: <input type="text" name="observacoes" value="{{$produto->observacoes}}"><br><br>
            @if($errors->has('observacoes'))
                <b style="color:red">Insira uma observação valida</b><br>
            @endif
            <input type="submit" value="enviar" class="btn btn-primary">
        </div>
    </form>
@endsection