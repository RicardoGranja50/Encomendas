@extends('layout')
@section('titulo')

@endsection
@section('conteudo')

<h3>Produtos : </h3>
<ul>
@foreach($produtos as $produto)
    <li>
        <a href="{{route('produtos.show', ['id'=>$produto->id_produto])}}">
		{{$produto->designacao}}
	</li>
@endforeach
</ul>
<a href="{{route('produtos.create')}}" class="btn btn-primary">Adicionar Produto</a>
@endsection