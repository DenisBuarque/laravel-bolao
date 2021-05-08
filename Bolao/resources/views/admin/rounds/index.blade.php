@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <form method="GET" action="{{ route('admin.rounds.index') }}" class="form-inline">
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
                    Rodadas <a href="{{ route('admin.rounds.index') }}">Lista de Registros</a>
                    <a href="{{ route('admin.rounds.create') }}" class="pull-right">Adicionar Registro</a>
                </div>

                <div class="panel-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Aposta</th>
                                <th scope="col">Data Inicio</th>
                                <th scope="col">Data Final</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rodadas as $value)
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->betting_title }}</td>
                                    <td>{{ $value->date_start_format }}</td>
                                    <td>{{ $value->date_end_format }}</td>
                                    <td>{{ substr($value->clock,0,5) }}</td>
                                    <td>
                                        
                                        <form method="POST" action="{{ route('admin.rounds.destroy', $value->id) }}">
                                            <a href="{{ route('admin.rounds.edit', $value->id) }}" class="btn btn-xs btn-success">
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

                    @if(!$search && $rodadas) 
                        <div class="">{{ $rodadas->links() }}</div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
