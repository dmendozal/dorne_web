@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.horario.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.horario.fields.dia') }}
                    </th>
                    <td>
                        {{ $horario->dia }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.horario.fields.hora_ini') }}
                    </th>
                    <td>
                        {!! $horario->hora_ini !!}
                    </td>
                </tr>
                <tr>
                    <th>
                       {{ trans('global.horario.fields.hora_fin') }}
                    </th>
                    <td>
                        {!! $horario->hora_fin !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.horario.fields.aula') }}
                    </th>
                    <td>
                        {!! $horario->aula !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.horario.fields.programacion_academica') }}
                    </th>
                    <td>
                        {!! $horario->programAcademica->descripcion !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection