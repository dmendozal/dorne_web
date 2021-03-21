@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.solicitud.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.solicitud.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
                <label for="descripcion">{{ trans('global.solicitud.fields.descripcion') }}*</label>
                <input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ old('descripcion', isset($solicitud) ? $solicitud->descripcion : '') }}">
                @if($errors->has('descripcion'))
                    <em class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.solicitud.fields.descripcion_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('cliente') ? 'has-error' : '' }}">
                    <label for="cliente">{{ trans('global.solicitud.fields.cliente') }}*
                    <select name="cliente" id="cliente" class="form-control ">
                    <option hidden selected ></option>
                            @foreach($cliente as $id => $clientes)
                            <option value="{{  $clientes->idcliente }}">Nombre: {{ $clientes->nombre }} CI: {{ $clientes->ci }}</option>
                            @endforeach
                    </select>
                    @if($errors->has('cliente'))
                        <em class="invalid-feedback">
                            {{ $errors->first('cliente') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('global.solicitud.fields.cliente_helper') }}
                    </p>
            </div>
            <div class="form-group {{ $errors->has('servicio') ? 'has-error' : '' }}">
                    <label for="servicio">{{ trans('global.solicitud.fields.servicio') }}*
                    <select name="servicio" id="servicio" class="form-control ">
                    <option hidden selected ></option>
                            @foreach($servicio as $id => $servicios)
                            <option value="{{  $servicios->idservicio }}">{{ $servicios->nombre }}</option>
                            @endforeach
                    </select>
                    @if($errors->has('servicio'))
                        <em class="invalid-feedback">
                                {{ $errors->first('servicio') }}
                        </em>
                    @endif
                    <p class="helper-block">
                            {{ trans('global.solicitud.fields.servicio_helper') }}
                    </p>
            </div>
            
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
