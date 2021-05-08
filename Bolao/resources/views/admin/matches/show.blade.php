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
                    Detalhes da Partida
                    <a href="{{ route('admin.matches.index') }}" class="pull-right">Listar Registro</a>
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-3">Tituto: </div>
                        <div class="col-md-9">{{ $partida->title }}</div>
                        <div class="col-md-3">Time A:</div>
                        <div class="col-md-9">{{ $partida->team_a }}</div>
                        <div class="col-md-3">Time B:</div>
                        <div class="col-md-9">{{ $partida->team_b }}</div>
                        <div class="col-md-3">Resltado:</div>
                        <div class="col-md-9">{{ $partida->result }}</div>
                        <div class="col-md-3">Placar A:</div>
                        <div class="col-md-9">{{ $partida->scoreboard_a }}</div>
                        <div class="col-md-3">Placar B:</div>
                        <div class="col-md-9">{{ $partida->scoreboard_b }}</div>
                        <div class="col-md-3">Data partida:</div>
                        <div class="col-md-9">{{ $partida->date }}</div>
                    </div>
                    <br><br>
                   
                    <form method="POST" action="{{ route('admin.matches.destroy', $partida->id) }}">
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
