@extends('layout')
@section('titulo')

@endsection
@section('conteudo')

<h3>{{$vendedores->nome}}</h3>
<ul>
    <li>Especialidade: {{$vendedores->especialidade}}</li>
    <li>Email: {{$vendedores->email}}</li>
</ul>
<a href="{{route('vendedores.edit', ['id'=>$vendedores->id_vendedor])}}" class="btn btn-primary">Editar Vendedor</a>
<a href="{{route('vendedores.destroy', ['id'=>$vendedores->id_vendedor])}}" class="btn btn-primary">Eliminar Vendedor</a>
@endsection