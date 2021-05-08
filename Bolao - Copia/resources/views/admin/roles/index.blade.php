@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <form method="GET" action="{{ route('admin.roles.index') }}" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="search" name="search" class="form-control" placeholder="Busca..." value="{{ $search }}">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>
            </form>
            <br>
            @if (session('alert'))
                <div class="alert alert-success">
                    {{ session('alert') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cargos e Funções <a href="{{ route('admin.roles.index') }}">Lista de Registros</a>
                    <a href="{{ route('admin.roles.create') }}" class="pull-right">Adicionar Registro</a>
                </div>

                <div class="panel-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $value)
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.roles.destroy', $value->id) }}">
                                            <a href="{{ route('admin.roles.edit', $value->id) }}" class="btn btn-xs btn-success">
                                                <span class="material-icons">mode_edit</span>
                                            </a>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <button type="submit" class="btn btn-xs btn-danger">
                                                <span class="material-icons">delete_forever</span>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if(!$search && $roles) 
                        <div class="">{{ $roles->links() }}</div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
