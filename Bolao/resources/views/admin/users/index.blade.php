@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <form method="GET" action="{{ route('admin.users.index') }}" class="form-inline">
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
                    Usuários <a href="{{ route('admin.users.index') }}">Lista de Registros</a>
                    @can('create-data')
                        <a href="{{ route('admin.users.create') }}" class="pull-right">Adicionar Registro</a>
                    @endcan
                </div>

                <div class="panel-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $value)
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        
                                        <form method="POST" action="{{ route('admin.users.destroy', $value->id) }}">
                                        <a href="{{ route('admin.users.show', $value->id ) }}" class="btn btn-xs btn-primary">
                                            <span class="material-icons">find_in_page</span>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $value->id) }}" class="btn btn-xs btn-success">
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

                    @if(!$search && $usuarios) 
                        <div class="">{{ $usuarios->links() }}</div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
