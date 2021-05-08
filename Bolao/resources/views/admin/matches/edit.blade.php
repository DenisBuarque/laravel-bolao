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
                    Formulário edição de partidada
                    <a href="{{ route('admin.matches.index') }}" class="pull-right">Lista de Registros</a>
                </div>

                <div class="panel-body">

                    <form method="POST" action="{{ route('admin.matches.update', $partida->id ) }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group row">
                            <label for="clockFor" class="col-sm-3 col-form-label">Partida</label>
                            <div class="col-sm-9">
                                <select name="round_id" class="form-control">
                                    @foreach($list_rounds as $key => $value)
                                        @php
                                            $selected = '';
                                            if(old('round_id') == $value->id):
                                                $selected = 'selected';
                                            else:
                                                if($partida->round_id == $value->id):
                                                    $selected = 'selected';
                                                endif;
                                            endif;
                                        @endphp
                                        <option {{ $selected }} value="{{ $value->id }}">{{ $value->title }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('round_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('round_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="titleFor" class="col-sm-3 col-form-label">Titulo da rodada</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" value="{{ old('title') ? old('title') : $partida->title }}" class="form-control" required autofocus id="titleFor" placeholder="">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stadiumFor" class="col-sm-3 col-form-label">Estadium</label>
                            <div class="col-sm-9">
                                <input type="text" name="stadium" value="{{ old('stadium') ? old('stadium') : $partida->stadium  }}" class="form-control" required autofocus id="stadiumFor" placeholder="">
                                @if ($errors->has('stadium'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stadium') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="team_aFor" class="col-sm-3 col-form-label">Nome time A</label>
                            <div class="col-sm-9">
                                <input type="text" name="team_a" value="{{ old('team_a') ? old('team_a') : $partida->team_a  }}" class="form-control" required autofocus id="team_aFor" placeholder="">
                                @if ($errors->has('team_a'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('team_a') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="team_bFor" class="col-sm-3 col-form-label">Nome time B</label>
                            <div class="col-sm-9">
                                <input type="text" name="team_b" value="{{ old('team_b') ? old('team_b') : $partida->team_b  }}" class="form-control" required autofocus id="team_bFor" placeholder="">
                                @if ($errors->has('team_b'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('team_b') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="resultFor" class="col-sm-3 col-form-label">Resultado</label>
                            <div class="col-sm-9">
                                <select name="result" class="form-control">
                                    @php
                                        $array = ['A' => 'Vitória time A', 'B' => 'Vitótia tiem B', 'E' => 'Empate'];
                                    @endphp
                                    @foreach($array as $key => $value)
                                        @php
                                            if($key == $partida->result):
                                                $selected = 'selected';
                                            else:
                                                $selected = '';
                                            endif;
                                        @endphp
                                        <option {{ $selected }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('result'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('result') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="scoreboard_aFor" class="col-sm-3 col-form-label">Placar time A</label>
                            <div class="col-sm-9">
                                <input type="text" name="scoreboard_a" value="{{ old('scoreboard_a') ? old('scoreboard_a') : $partida->scoreboard_a  }}" class="form-control" required autofocus id="scoreboard_aFor" placeholder="">
                                @if ($errors->has('scoreboard_a'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('scoreboard_a') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="scoreboard_bFor" class="col-sm-3 col-form-label">Placar time B</label>
                            <div class="col-sm-9">
                                <input type="text" name="scoreboard_b" value="{{ old('scoreboard_b') ? old('scoreboard_b') : $partida->scoreboard_b  }}" class="form-control" required autofocus id="scoreboard_bFor" placeholder="">
                                @if ($errors->has('scoreboard_b'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('scoreboard_b') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateFor" class="col-sm-3 col-form-label">Data da rodada</label>
                            <div class="col-sm-9">
                                <input type="date" name="date" value="{{ old('date') ? old('date') : $partida->date }}" class="form-control" required autofocus id="dateFor" placeholder="">
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
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
