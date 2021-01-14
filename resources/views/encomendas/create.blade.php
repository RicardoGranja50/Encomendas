@extends('layout')
@section('titulo')

@endsection
@section('conteudo')
    <h3 style="font-family:Noto Sans"> Adicionar Encomenda</h3><br>
    <form action="{{route('encomendas.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="container-fluid">

            @if($errors->has('id_produto'))
                <b style="color:red">Insira o produto</b><br>
            @endif

            Vendedor
            <select name="id_vendedor">
                @foreach($vendedores as $vendedor)
                    <option value="{{$vendedor->id_vendedor}}">{{$vendedor->nome}}</option>
                @endforeach
            </select>
            <br><br>
            @if($errors->has('id_vendedor'))
                <b style="color:red">Insira o vendedor</b><br>
            @endif

            Cliente
            <select name="id_cliente">
                @foreach($clientes as $cliente)
                    <option value="{{$cliente->id_cliente}}">{{$cliente->nome}}</option>
                @endforeach
            </select>
            <br><br>
            @if($errors->has('id_cliente'))
                <b style="color:red">Insira o cliente</b><br>
            @endif
           Data: (<b style="color:red">*</b>)<input type="date" name="data" value="{{old('data')}}"><br><br>

           

            @if($errors->has('data'))
                <b style="color:red">Insira uma data</b><br>
            @endif



            Observaçao: <input type="text" name="observacao" value="{{old('observacao')}}"><br><br>

            @if($errors->has('observacao'))
                <b style="color:red">Insira um comentario entre 5 e 200 caracteres</b><br>
            @endif
            <input type="submit" value="Criar" class="btn btn-primary">
        </div>

    </form>

@endsection