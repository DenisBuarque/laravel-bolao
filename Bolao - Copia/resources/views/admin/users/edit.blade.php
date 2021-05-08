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
                    Formulário edição de usuário
                    <a href="{{ route('admin.users.index') }}" class="pull-right">Lista de Registros</a>
                </div>

                <div class="panel-body">

                @if (session('alert'))
                    <div class="alert alert-danger">
                        {{ session('alert') }}
                    </div>
                @endif

                    <form method="POST" action="{{ route('admin.users.update', $usuario->id ) }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nome</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{ old('name') ? old('name') : $usuario->name }}" class="form-control" required autofocus id="" placeholder="">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" value="{{ old('email') ? old('email') : $usuario->email }}" class="form-control" required id="" placeholder="">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" id="" placeholder="">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation" class="form-control" id="" placeholder="">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Cargo ou Função (role)</label>
                            <div class="col-sm-9">
                                <select multiple name="roles[]" class="form-control">
                                    @foreach($roles as $value)
                                        
                                        @php        
                                            $selected = '';
                                            if( old('roles') )
                                            {
                                                foreach ( old('roles') as $key => $value2 ):
                                                    if($value2 == $value->id ){
                                                        $selected = 'selected';
                                                    }
                                                endforeach;
                                            } else {
                                                if( $roles ) 
                                                {
                                                    foreach( $usuario->roles as $key => $role):
                                                        if($role->id == $value->id):
                                                            $selected = "selected";
                                                        endif;
                                                    endforeach;
                                                }
                                            }
                                        @endphp

                                        <option {{ $selected }} value="{{ $value->id }}">{{ $value->description }}</option>
                                    @endforeach
                                </select>
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
