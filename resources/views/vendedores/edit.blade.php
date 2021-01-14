@extends('layout')
@section('titulo')

@endsection
@section('conteudo')
    <form action="{{route('vendedores.update', ['id'=>$vendedor->id_vendedor])}}"enctype="multipart/form-data" method="post">
        @csrf
        @method('patch')
        
        <div class="container-fluid">

        	Nome: (<b style="color:red">*</b>)<input type="text" name="nome" value="{{$vendedor->nome}}"><br><br>
                @if($errors->has('nome'))
                    <b style="color:red">O nome deve ser entre 3 e 100 caracteres</b><br>
                @endif

            Especialidade: (<b style="color:red">*</b>)<input type="text" name="especialidade" value="{{$vendedor->especialidade}}"><br><br>
                @if($errors->has('especialidade'))
                    <b style="color:red">A especialidade deve ser entre 3 e 100 caracteres</b><br>
                @endif

            Email: (<b style="color:red">*</b>)<input type="text" name="email" value="{{$vendedor->email}}"><br><br>
                @if($errors->has('email'))
                    <b style="color:red">O email deve ser entre 5 e 200 caracteres</b><br>
                @endif
            <input type="submit" value="enviar" class="btn btn-primary">
        </div>
    </form>
@endsection