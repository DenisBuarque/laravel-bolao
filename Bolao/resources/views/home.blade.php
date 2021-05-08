@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard - Aplicação bolão familiar</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <ul>
                        @can('access-user')
                            <li>Acesse a <a href="{{ route('admin.users.index') }}">Lista de Usuários</a> da aplicação.</li>
                        @endcan
                        @can('access-role')
                            <li>Acesse a <a href="{{ route('admin.permissions.index') }}">Lista de Permissões</a> de usuários.</li>
                        @endcan
                        @can('access-permissions')
                            <li>Acesse a <a href="{{ route('admin.roles.index') }}">Lista de Cargos/Funções</a> de usuários.</li>
                        @endcan
                        @can('access-bets')
                            <li>Acesse a <a href="{{ route('admin.bettings.index') }}">Lista de aposta</a> de usuários.</li>
                        @endcan
                        @can('access-rounds')
                            <li>Acesse a <a href="{{ route('admin.rounds.index') }}">Lista de rodadas</a>.</li>
                        @endcan
                        @can('access-matches')
                            <li>Acesse a <a href="{{ route('admin.matches.index') }}">Lista de partidas</a>.</li>
                        @endcan
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
