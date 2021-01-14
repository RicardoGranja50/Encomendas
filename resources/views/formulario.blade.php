@extends('layout')
@section('titulo')

@endsection
@section('conteudo')
<div class="container">
    
        <div class="col-sm">
            Pesquisa pelo cliente para procurar pela ficha de cada cliente.
        </div>
</div>
<br>
<form class="form-inline my-2 my-lg-0" method="post" action="{{route('mostrar')}}">
        @csrf
    <input  class="form-control mr-sm-2" type="search" name="nome" placeholder="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
<div class="col-sm-3">
@endsection

@section('c')
@endsection