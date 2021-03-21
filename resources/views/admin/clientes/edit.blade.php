@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.horario.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.horarios.update", [$horario->idhorario]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('dia') ? 'has-error' : '' }}">
                <label for="dia">{{ trans('global.horario.fields.dia') }}*</label>
                <input type="text" id="dia" name="dia" class="form-control" value="{{ old('dia', isset($horario) ? $horario->dia : '') }}">
                @if($errors->has('dia'))
                    <em class="invalid-feedback">
                        {{ $errors->first('dia') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.horario.fields.dia_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('hora_ini') ? 'has-error' : '' }}">
                <label for="hora_ini">{{ trans('global.horario.fields.hora_ini') }}</label>
                <input id="hora_ini" name="hora_ini" class="form-control " value="{{ old('hora_ini', isset($horario) ? $horario->hora_ini : '') }}">
                @if($errors->has('hora_ini'))
                    <em class="invalid-feedback">
                        {{ $errors->first('hora_ini') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.horario.fields.hora_ini_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('hora_fin') ? 'has-error' : '' }}">
                <label for="hora_fin">{{ trans('global.horario.fields.hora_fin') }}</label>
                <input id="hora_fin" name="hora_fin" class="form-control " value="{{ old('hora_fin', isset($horario) ? $horario->hora_fin : '') }}">
                @if($errors->has('hora_fin'))
                    <em class="invalid-feedback">
                        {{ $errors->first('hora_fin') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.horario.fields.hora_fin_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('aula') ? 'has-error' : '' }}">
                    <label for="aula">{{ trans('global.horario.fields.aula') }}</label>
                    <input id="aula" name="hora_fin" class="form-control " value="{{ old('aula', isset($horario) ? $horario->aula : '') }}">
                    @if($errors->has('aula'))
                        <em class="invalid-feedback">
                            {{ $errors->first('aula') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('global.horario.fields.aula_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('programacion_academica') ? 'has-error' : '' }}">
                        <label for="programacion_academica">{{ trans('global.horario.fields.programacion_academica') }}*
                        <select name="fkidprogramacionacademica" id="programacion_academica" class="form-control ">
                        <option hidden selected value="{{$horario->programAcademica->idprogramacionacademica}}">{{$horario->programAcademica->descripcion}}</option>
                                @foreach($programAcademica as $id => $programAcademica)
                                <option value="{{$id}}">{{$programAcademica}}</option>
                                @endforeach
                        </select>
                        @if($errors->has('programacion_academica'))
                            <em class="invalid-feedback">
                                {{ $errors->first('programacion_academica') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.horario.fields.programacion_academica_helper') }}
                        </p>
                    </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection