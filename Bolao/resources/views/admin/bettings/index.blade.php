@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <form method="GET" action="{{ route('admin.bettings.index') }}" class="form-inline">
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
                    Apostas Bolão <a href="{{ route('admin.bettings.index') }}">Lista de Registros</a>
                    @can('create-data')
                        <a href="{{ route('admin.bettings.create') }}" class="pull-right">Adicionar Registro</a>
                    @endcan
                </div>

                <div class="panel-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Usuários</th>
                                <th scope="col">Rodada atual</th>
                                <th scope="col">Valor resultado</th>
                                <th scope="col">Taxa extra</th>
                                <th scope="col">Valor Taxa</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apostas as $value)
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->user_id }}</td>
                                    <td>{{ $value->current_round }}</td>
                                    <td>{{ $value->value_result }}</td>
                                    <td>{{ $value->extra_value }}</td>
                                    <td>{{ $value->value_fee }}</td>
                                    <td>
                                        
                                        <form method="POST" action="{{ route('admin.bettings.destroy', $value->id) }}">

                                        <a href="{{ route('admin.bettings.show', $value->id ) }}" class="btn btn-xs btn-primary">
                                            <span class="material-icons">find_in_page</span>
                                        </a>
                                        <a href="{{ route('admin.bettings.edit', $value->id) }}" class="btn btn-xs btn-success">
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

                    @if(!$search && $apostas) 
                        <div class="">{{ $apostas->links() }}</div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
