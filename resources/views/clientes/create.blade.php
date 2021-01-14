@extends('layout')
@section('titulo')

@endsection
@section('conteudo')
    <h3 style="font-family:Noto Sans"> Adicionar Cliente</h3><br>
    <form action="{{route('clientes.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="container-fluid">
            
                Nome: (<b style="color:red">*</b>)<input type="text" name="nome" value="{{old('nome')}}"><br><br>
                @if($errors->has('nome'))
                    <b style="color:red">O nome deve ser entre 3 e 100 caracteres</b><br>
                @endif
           
            
                Morada: (<b style="color:red">*</b>)<input type="text" name="morada" value="{{old('morada')}}"><br><br>
                @if($errors->has('morada'))
                    <b style="color:red">A morada deve ser entre 3 e 100 caracteres</b><br>
                @endif
            
            
                Telefone: (<b style="color:red">*</b>)<input type="text" name="telefone" value="{{old('telefone')}}"><br><br>
                @if($errors->has('telefone'))
                    <b style="color:red">O numero de telefone deve se encontrar entre 9 e 13</b><br>
                @endif
            
            
                Email: (<b style="color:red">*</b>)<input type="text" name="email" value="{{old('email')}}"><br><br>
                @if($errors->has('email'))
                    <b style="color:red">O email deve ser entre 5 e 200 caracteres</b><br>
                @endif

                <input type="submit" value="Criar" class="btn btn-primary">
        
            </div>

        </div>
    </form>
@endsection