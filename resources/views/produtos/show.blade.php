@extends('layout')
@section('titulo')

@endsection
@section('conteudo')


<h3>{{$produtos->designacao}}</h3>
<ul>
    <li>Stock: {{$produtos->stock}}</li> 
   	<div class="container-fluid">
   		<a href="{{route('produtos.stock.mais', ['id'=>$produtos->id_produto])}}">+</a>
   		<a href="{{route('produtos.stock.menos', ['id'=>$produtos->id_produto])}}">-</a>
   	</div>
    <li>Preço: {{$produtos->preco}}€</li>
    <li>Observações: {{$produtos->observacoes}}</li>
    @foreach($produtos->encomendas as $encomenda)
    <li>Encomenda: <a href="{{route('encomendas.show', ['id'=>$encomenda->id_encomenda])}}">{{$encomenda->data}}</a></li>
    @endforeach
</ul>
<a href="{{route('produtos.edit', ['id'=>$produtos->id_produto])}}" class="btn btn-primary">Editar Produto</a>
<a href="{{route('produtos.destroy', ['id'=>$produtos->id_produto])}}" class="btn btn-primary">Eliminar Produto</a>
@endsection