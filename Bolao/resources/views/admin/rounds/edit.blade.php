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
                    Formulário edição de rodada
                    <a href="{{ route('admin.rounds.index') }}" class="pull-right">Lista de Registros</a>
                </div>

                <div class="panel-body">

                    <form method="POST" action="{{ route('admin.rounds.update', $rodada->id ) }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        
                        <div class="form-group row">
                            <label for="titleFor" class="col-sm-3 col-form-label">Titulo da rodada</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" value="{{ old('title') ? old('title') : $rodada->title }}" class="form-control" autofocus id="titleFor" placeholder="">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="startFor" class="col-sm-3 col-form-label">Data Inicio</label>
                            <div class="col-sm-9">
                                <input type="date" name="date_start" value="{{ old('date_start') ? old('date_start') : $rodada->date_start }}" class="form-control" required autofocus id="tartFor" placeholder="">
                                @if ($errors->has('date_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="endFor" class="col-sm-3 col-form-label">Data Final</label>
                            <div class="col-sm-9">
                                <input type="date" name="date_end" value="{{ old('date_end') ? old('date_end') : $rodada->date_end }}" class="form-control" required autofocus id="endFor" placeholder="">
                                @if ($errors->has('date_end'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="clockFor" class="col-sm-3 col-form-label">Hora</label>
                            <div class="col-sm-9">
                                <input type="time" name="clock" value="{{ old('clock') ? old('clock') : $rodada->clock }}" class="form-control" required autofocus id="clockFor" placeholder="">
                                @if ($errors->has('clock'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clock') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="clockFor" class="col-sm-3 col-form-label">Aposta</label>
                            <div class="col-sm-9">
                                <select name="betting_id" class="form-control">
                                    @foreach($list_bettings as $key => $value)
                                        @php
                                            $selected = '';
                                            if(old('betting_id') == $value->id):
                                                $selected = 'selected';
                                            else:
                                                if($rodada->betting_id == $value->id):
                                                    $selected = 'selected';
                                                endif;
                                            endif;
                                        @endphp
                                        <option {{ $selected }} value="{{ $value->id }}">{{ $value->title }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('betting_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('betting_id') }}</strong>
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
