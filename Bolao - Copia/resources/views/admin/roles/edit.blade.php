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
                    Formulário edição cargo ou função
                    <a href="{{ route('admin.roles.index') }}" class="pull-right">Lista de Registros</a>
                </div>

                <div class="panel-body">

                    <form method="POST" action="{{ route('admin.roles.update', $role->id ) }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nome</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{ old('name') ? old('name') : $role->name }}" class="form-control" required autofocus id="" placeholder="">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Descrição</label>
                            <div class="col-sm-9">
                                <input type="text" name="description" value="{{ old('description') ? old('description') : $role->description }}" class="form-control" required id="" placeholder="">
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Permissões</label>
                            <div class="col-sm-9">
                                <select multiple name="permissions[]" class="form-control">
                                    @foreach($permissoes as $value)
                                        
                                        @php        
                                            $selected = '';
                                            if( old('permissions') )
                                            {
                                                foreach ( old('permissions') as $key => $value2 ):
                                                    if($value2 == $value->id ){
                                                        $selected = 'selected';
                                                    }
                                                endforeach;
                                            } else {
                                                if( $role ) 
                                                {
                                                    foreach( $role->permissions as $key => $permission):
                                                        if($permission->id == $value->id):
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
