@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <form method="GET" action="{{ route('admin.matches.index') }}" class="form-inline">
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
                    Partidas <a href="{{ route('admin.matches.index') }}">Lista de Registros</a>
                    <a href="{{ route('admin.matches.create') }}" class="pull-right">Adicionar Registro</a>
                </div>

                <div class="panel-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Time A</th>
                                <th scope="col">Time B</th>
                                <th scope="col">Resultado</th>
                                <th scope="col">Placar A</th>
                                <th scope="col">Placar B</th>
                                <th scope="col">Data</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partidas as $value)
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->team_a }}</td>
                                    <td>{{ $value->team_b }}</td>
                                    <td>{{ $value->result }}</td>
                                    <td>{{ $value->scoreboard_a }}</td>
                                    <td>{{ $value->scoreboard_b }}</td>
                                    <td>{{ $value->date }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.matches.destroy', $value->id) }}">
                                            <a href="{{ route('admin.matches.show', $value->id) }}" class="btn btn-xs btn-info">
                                                <span class="material-icons">find_in_page</span>
                                            </a>
                                            <a href="{{ route('admin.matches.edit', $value->id) }}" class="btn btn-xs btn-success">
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

                    @if(!$search && $partidas) 
                        <div class="">{{ $partidas->links() }}</div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
