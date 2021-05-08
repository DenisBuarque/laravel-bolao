@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <form method="GET" action="{{ route('admin.permissions.index') }}" class="form-inline">
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
                    Permissões <a href="{{ route('admin.permissions.index') }}">Lista de Registros</a>
                    <a href="{{ route('admin.permissions.create') }}" class="pull-right">Adicionar Registro</a>
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
                            @foreach ($permissao as $value)
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>
                                        
                                        <form method="POST" action="{{ route('admin.permissions.destroy', $value->id) }}">
                                            <a href="{{ route('admin.permissions.edit', $value->id) }}" class="btn btn-xs btn-success">
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

                    @if(!$search && $permissao) 
                        <div class="">{{ $permissao->links() }}</div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
