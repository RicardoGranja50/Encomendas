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
<br>
<a href="{{route('clientes.edit',['id'=>$clientes->id_cliente])}}" class="btn btn-primary">Editar Cliente</a>
<a href="{{route('clientes.destroy',['id'=>$clientes->id_cliente])}}" class="btn btn-primary">Eliminar Cliente</a>
@endsection