@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.empleados.create") }}">
                {{ trans('global.add') }} {{ trans('global.empleado.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('global.empleado.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.empleado.fields.nombre') }}
                        </th>
                        <th>
                            {{ trans('global.empleado.fields.ci') }}
                        </th>
                        <th>
                            {{ trans('global.empleado.fields.email') }}
                        </th>
                        <th>
                            {{ trans('global.empleado.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('global.empleado.fields.direccion') }}
                        </th>
                        <th>
                            {{ trans('global.empleado.fields.telefono') }}
                        </th>
                        <th>
                            {{ trans('global.empleado.fields.sueldo') }}(Bs)
                        </th>
                        <th>
                            {{ trans('global.empleado.fields.username') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $key => $empleado)
                        <tr data-entry-id="{{ $empleado->idempleado }}">
                            <td>

                            </td>
                            <td>
                                {{ $empleado->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->ci ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->email ?? '' }}
                            </td>
                         <td style="color:white" bgcolor={{($empleado->estados->idestado==1)?'#7FFF00':'#DC143C'}}>
                                {{ $empleado->estados->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->direccion ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->telefono ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->sueldo ?? '' }}
                            </td>
                            <td>
                                {{ $empleado->username ?? '' }}
                            </td>

                            <td>

                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.empleados.show', $empleado->idempleado) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.empleados.edit', $empleado->idempleado) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('admin.empleados.destroy', $empleado->idempleado) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'

        let deleteButton = {
            text: deleteButtonTrans,
            className: 'btn-danger',

            action: function (e, dt, node, config) {
            var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
            });
            if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
            }
            if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
            }
            }
        }
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        //@can('horario_delete')
        dtButtons.push(deleteButton)
        //@endcan

        $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    })

</script>
@endsection
@endsection
