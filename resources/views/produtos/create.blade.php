@extends('layout')
@section('titulo')

@endsection
@section('conteudo')
	<h3 style="font-family:Noto Sans"> Adicionar Cliente</h3><br>
    <form action="{{route('produtos.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="container-fluid">
        	Nome Produto: (<b style="color:red">*</b>)<input type="text" name="designacao" value="{{old('designacao')}}"><br><br>
            @if($errors->has('designacao'))
                <b style="color:red">O nome do produto deve ser entre 3 e 100 caracteres</b><br>
            @endif

            Stock: (<b style="color:red">*</b>)<input type="text" name="stock" value="{{old('stock')}}"><br><br>
            @if($errors->has('stock'))
                <b style="color:red">Insira um stock valido</b><br>
            @endif

            Preço: (<b style="color:red">*</b>)<input type="text" name="preco" value="{{old('preco')}}"><br><br>
            @if($errors->has('preco'))
                <b style="color:red">Insira um preço</b><br>
            @endif

           	Observaçoes: <input type="text" name="observacoes" value="{{old('observacoes')}}"><br><br>
            @if($errors->has('observacoes'))
                <b style="color:red">Insira uma observação valida</b><br>
            @endif

            <input type="submit" value="Criar" class="btn btn-primary">
     	</div>
    </form>
@endsection