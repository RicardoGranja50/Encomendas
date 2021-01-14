@extends('layout')
@section('titulo')

@endsection
@section('conteudo')
<h3>Clientes : </h3>
<ul>
@foreach($clientes as $cliente)
    <li>
        <a href="{{route('clientes.show', ['id'=>$cliente->id_cliente])}}">
		{{$cliente->nome}}
	</li>
@endforeach
</ul>
<br>
<a href="{{route('clientes.create')}}" class="btn btn-primary">Adicionar Cliente</a>
@endsection