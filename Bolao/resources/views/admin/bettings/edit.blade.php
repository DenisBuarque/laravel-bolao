@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if (session('alert'))
                <div class="alert alert-success">
                    {{ session('alert') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulário edição de aposta
                    <a href="{{ route('admin.bettings.index') }}" class="pull-right">Lista de Registros</a>
                </div>

                <div class="panel-body">

                @if (session('alert'))
                    <div class="alert alert-danger">
                        {{ session('alert') }}
                    </div>
                @endif

                    <form method="POST" action="{{ route('admin.bettings.update', $aposta->id ) }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group row">
                            <label for="titleForm" class="col-sm-3 col-form-label">Nome</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" value="{{ old('title') ? old('title') : $aposta->title }}" class="form-control" required autofocus id="titleForm" placeholder="">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="roundForm" class="col-sm-3 col-form-label">Valor do esultado</label>
                            <div class="col-sm-9">
                                <input type="text" name="value_result" value="{{ old('value_result') ? old('value_result') : $aposta->value_result }}" class="form-control" autofocus id="roundForm" placeholder="">
                                @if ($errors->has('value_result'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('value_result') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="extraForm" class="col-sm-3 col-form-label">Valor extra</label>
                            <div class="col-sm-9">
                                <input type="text" name="extra_value" value="{{ old('extra_value') ? old('extra_value') : $aposta->extra_value }}" class="form-control" autofocus id="extraForm" placeholder="">
                                @if ($errors->has('extra_value'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('extra_value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="feeForm" class="col-sm-3 col-form-label">Valor da taxa</label>
                            <div class="col-sm-9">
                                <input type="text" name="value_fee" value="{{ old('value_fee') ? old('value_fee') : $aposta->value_fee }}" class="form-control" autofocus id="feeForm" placeholder="">
                                @if ($errors->has('value_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('value_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn-block">Salvar Dados</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
