@extends('layout')
@section('titulo')

@endsection
@section('conteudo')

<h3> <a href="{{route('clientes.show',['id'=>$encomendas->cliente->id_cliente])}}">{{$encomendas->cliente->nome}}</a></h3>
<ul>
    <li>Data: {{$encomendas->data}}</li>
    <li>Observações: {{$encomendas->observacoes}}</li>
    <li>Vendedor: <a href="{{route('vendedores.show',['id'=>$encomendas->vendedor->id_vendedor])}}">{{$encomendas->vendedor->nome}}</a></li>
    <br>
    @foreach($relacao as $produto)
    
    <li><b>Produto: </b><a href="{{route('produtos.show',['id'=>$produto->id_produto])}}">{{$produto->produto->designacao}}</a> 
    
    <a href="{{route('encomendas.edit.produto',['id'=>$encomendas->id_encomenda,'idp'=>$produto->id_produto])}}"><i class="fas fa-pencil-alt"></i></a>
    
    <a href="{{route('encomendas.destroy.produto',['id'=>$encomendas->id_encomenda,'idp'=>$produto->id_produto])}}"><i class="fas fa-trash"></i></a>
    </li>
    <li>Quantidade: {{$produto->quantidade}}</li>
    <li>Preço: {{$produto->preco}}</li><br>
    @endforeach
</ul>
<br>
<a href="{{route('encomendas.create.produto',['id'=>$encomendas->id_encomenda])}}" class="btn btn-primary">Adicionar Produto</a>

@endsection