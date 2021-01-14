@extends('layout')
@section('titulo')

@endsection
@section('conteudo')
    <form action="{{route('clientes.update', ['id'=>$cliente->id_cliente])}}"enctype="multipart/form-data" method="post">
        @csrf
        @method('patch')
        
        <div class="container-fluid">
            
                Nome: (<b style="color:red">*</b>)<input type="text" name="nome" value="{{$cliente->nome}}"><br><br>
                @if($errors->has('nome'))
                    <b style="color:red">O nome deve ser entre 3 e 100 caracteres</b><br>
                @endif
            

            
                Morada: (<b style="color:red">*</b>)<input type="text" name="morada" value="{{$cliente->morada}}"><br><br>
                @if($errors->has('morada'))
                    <b style="color:red">A morada deve ser entre 3 e 100 caracteres</b><br>
                @endif
            

            
                Telefone: (<b style="color:red">*</b>)<input type="text" name="telefone" value="{{$cliente->telefone}}"><br><br>
                @if($errors->has('telefone'))
                    <b style="color:red">O numero de telefone deve se encontrar entre 9 e 13</b><br>
                @endif
            

                Email: (<b style="color:red">*</b>)<input type="text" name="email" value="{{$cliente->email}}"><br><br>
                @if($errors->has('email'))
                    <b style="color:red">O email deve ser entre 5 e 200 caracteres</b><br>
                @endif
                <input type="submit" value="enviar" class="btn btn-primary">
        </div>
    </form>
@endsection