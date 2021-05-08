@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if (session('alert'))
                <div class="alert alert-danger">
                    {{ session('alert') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    Detalhes do Usuário 
                    <a href="{{ route('admin.users.index') }}" class="pull-right">Listar Registro</a>
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-3">Nome: </div>
                        <div class="col-md-9">{{ $usuario->name }}</div>
                        <div class="col-md-3">E-mail:</div>
                        <div class="col-md-9">{{ $usuario->email }}</div>
                    </div>
                    <br><br>
                   
                    <form method="POST" action="{{ route('admin.users.destroy', $usuario->id) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <button type="submit" class="btn btn-danger btn-sm">Excluir Registro</button>
                    </form>
                   

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
