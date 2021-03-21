@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.horario.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.horarios.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('entrada') ? 'has-error' : '' }}">
                <label for="entrada">{{ trans('global.horario.fields.entrada') }}*</label>
                <input type="time" id="entrada" name="entrada" class="form-control" value="{{ old('entrada', isset($horario) ? $horario->entrada : '') }}">
                @if($errors->has('entrada'))
                    <em class="invalid-feedback">
                        {{ $errors->first('entrada') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.horario.fields.entrada_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('salida') ? 'has-error' : '' }}">
                <label for="salida">{{ trans('global.horario.fields.salida') }}*</label>
                <input type="time" id="salida" name="salida" class="form-control" value="{{ old('salida', isset($horario) ? $horario->salida : '') }}">
                @if($errors->has('salida'))
                <em class="invalid-feedback">
                    {{ $errors->first('salida') }}
                </em>
                @endif
                <p class="helper-block">
                        {{ trans('global.horario.fields.salida_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('tipo') ? 'has-error' : '' }}">
                <label for="tipo">{{ trans('global.horario.fields.tipo') }}*</label>
                <input type="text" id="tipo" name="tipo" class="form-control" value="{{ old('tipo', isset($horario) ? $horario->tipo : '') }}">
                @if($errors->has('tipo'))
                <em class="invalid-feedback">
                    {{ $errors->first('tipo') }}
                </em>
                @endif
                <p class="helper-block">
                        {{ trans('global.horario.fields.tipo_helper') }}
                </p>
            </div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
