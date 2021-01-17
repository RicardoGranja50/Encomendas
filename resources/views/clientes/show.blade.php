@extends('layout')
@section('titulo')

@endsection
@section('conteudo')

<h3>{{$clientes->nome}}</h3>
<ul>
    <li>Morada: {{$clientes->morada}}</li>
    <li>Telefone: {{$clientes->telefone}}</li>
    <li>Email: {{$clientes->email}}</li>
    @foreach($clientes->encomenda as $encomenda)
        <li>Encomenda: <a href="{{route('encomendas.show', ['id'=>$encomenda->id_encomenda])}}">{{$encomenda->data}}</a></li>
    @endforeach
</ul>
@if(!is_null($clientes->foto_cliente))
	<img src="{{asset('imagens/clientes/'.$clientes->foto_cliente)}}" width="200px">
	<br>
@endif
<br>
@if(Gate::allows('admin') || Gate::allows('gate',$clientes))
	<a href="{{route('clientes.edit',['id'=>$clientes->id_cliente])}}" class="btn btn-primary">Editar Cliente</a>
	<a href="{{route('clientes.destroy',['id'=>$clientes->id_cliente])}}" class="btn btn-primary">Eliminar Cliente</a>
	<a href="{{route('clientes.email',['id'=>$clientes->id_cliente])}}" class="btn btn-primary">Enviar por email</a>
@endif
@endsection