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
                    Detalhes da aposta
                    <a href="{{ route('admin.bettings.index') }}" class="pull-right">Listar Registro</a>
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-3">Usuário: </div>
                        <div class="col-md-9">{{ $aposta->user_id }}</div>
                        <div class="col-md-3">Rodada atual: </div>
                        <div class="col-md-9">{{ $aposta->current_round }}</div>
                        <div class="col-md-3">Valor resultado: </div>
                        <div class="col-md-9">{{ $aposta->value_result }}</div>
                        <div class="col-md-3">Taxa extra: </div>
                        <div class="col-md-9">{{ $aposta->extra_value }}</div>
                        <div class="col-md-3">Taxa: </div>
                        <div class="col-md-9">{{ $aposta->value_fee }}</div>
                    </div>
                    <br><br>
                   
                    <form method="POST" action="{{ route('admin.bettings.destroy', $aposta->id) }}">
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
