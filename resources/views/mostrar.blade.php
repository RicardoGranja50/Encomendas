@extends('layout')
@section('titulo')

@endsection
@section('conteudo')

@if(count($clientes)==0)
  <h3>Cliente nao encontrado</h3>
    <ul>
      <li>{{$pesquisa}}</li>
    </ul>
@else 
  <table class="table table-dark">
  <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Morada</th>
        <th scope="col">Telefone</th>
        <th scope="col">Email</th>
        <th scope="col">Data Encomenda</th>
      </tr>
  </thead>
  @foreach($clientes as $costumer)
    <tbody>
        <tr>
          <th scope="row">{{$costumer->nome}}</th>
          <td>{{$costumer->morada}}</td>
          <td>{{$costumer->telefone}}</td>
          <td>{{$costumer->email}}</td>
          @foreach($costumer->encomenda as $encomendas)
          <td>{{$encomendas->data}}</td>
          @endforeach
        </tr>
      </tbody>
  @endforeach
  </table>
@endif

@endsection












