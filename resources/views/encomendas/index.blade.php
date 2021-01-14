@extends('layout')
@section('titulo')

@endsection
@section('conteudo')

<h3>Encomendas : </h3>
<ul>
@foreach($encomendas as $encomenda)
    <li>
		<a href="{{route('encomendas.show', ['id'=>$encomenda->id_encomenda])}}">
		{{$encomenda->data}}
	</li>
@endforeach
</ul>

<a href="{{route('encomendas.create')}}" class="btn btn-primary">Adicionar Encomenda</a>
@endsection