@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.empleado.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.empleados.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                <label for="nombre">{{ trans('global.empleado.fields.nombre') }}*</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', isset($empleado) ? $empleado->nombre : '') }}">
                @if($errors->has('nombre'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.empleado.fields.nombre_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('ci') ? 'has-error' : '' }}">
                <label for="ci">{{ trans('global.empleado.fields.ci') }}*</label>
                <input type="text" id="ci" name="ci" class="form-control" value="{{ old('ci', isset($empleado) ? $empleado->ci : '') }}">
                @if($errors->has('ci'))
                <em class="invalid-feedback">
                    {{ $errors->first('ci') }}
                </em>
                @endif
                <p class="helper-block">
                        {{ trans('global.empleado.fields.ci_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('global.empleado.fields.email') }}*</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email', isset($empleado) ? $empleado->email : '') }}">
                @if($errors->has('email'))
                <em class="invalid-feedback">
                    {{ $errors->first('email') }}
                </em>
                @endif
                <p class="helper-block">
                        {{ trans('global.empleado.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('direccion') ? 'has-error' : '' }}">
                <label for="direccion">{{ trans('global.empleado.fields.direccion') }}*</label>
                <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion', isset($empleado) ? $empleado->direccion : '') }}">
                @if($errors->has('direccion'))
                    <em class="invalid-feedback">
                        {{ $errors->first('direccion') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.empleado.fields.direccion_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
                <label for="telefono">{{ trans('global.empleado.fields.telefono') }}*</label>
                <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono', isset($empleado) ? $empleado->telefono : '') }}">
                @if($errors->has('telefono'))
                <em class="invalid-feedback">
                {{ $errors->first('telefono') }}
                </em>
                @endif
                 <p class="helper-block">
                 {{ trans('global.empleado.fields.telefono_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('sueldo') ? 'has-error' : '' }}">
                <label for="sueldo">{{ trans('global.empleado.fields.sueldo') }}*</label>
                <input type="number" id="sueldo" name="sueldo" class="form-control" value="{{ old('sueldo', isset($empleado) ? $empleado->sueldo : '') }}">
                @if($errors->has('sueldo'))
                <em class="invalid-feedback">
                {{ $errors->first('sueldo') }}
                </em>
                @endif
                 <p class="helper-block">
                 {{ trans('global.empleado.fields.sueldo_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                <label for="username">{{ trans('global.empleado.fields.username') }}*</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username', isset($empleado) ? $empleado->username : '') }}">
                @if($errors->has('username'))
                <em class="invalid-feedback">
                {{ $errors->first('username') }}
                </em>
                @endif
                 <p class="helper-block">
                 {{ trans('global.empleado.fields.username_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('global.empleado.fields.password') }}*</label>
                <input type="password" id="password" name="password" class="form-control" value="{{ old('password', isset($empleado) ? $empleado->password : '') }}">
                @if($errors->has('password'))
                <em class="invalid-feedback">
                {{ $errors->first('password') }}
                </em>
                @endif
                 <p class="helper-block">
                 {{ trans('global.empleado.fields.password_helper') }}
                </p>
            </div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
