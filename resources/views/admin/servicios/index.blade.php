@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.servicio.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.servicio.fields.entrada') }}
                        </th>
                        <th>
                            {{ trans('global.servicio.fields.salida') }}
                        </th>
                        <th>
                            {{ trans('global.servicio.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('global.servicio.fields.cliente') }}
                        </th>
                        <th>
                            {{ trans('global.servicio.fields.empleado') }}
                        </th>
                        <th>
                            {{ trans('global.servicio.fields.servicio') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $key => $servicio)
                        <tr data-entry-id="{{ $servicio->idempleadoservicio }}">
                            <td>

                            </td>
                            <td>
                                {{ $servicio->entrada ?? 'Aun no marco entrada' }}
                            </td>
                            <td>
                                {{ $servicio->salida ?? 'Aun no marco salida' }}
                            </td>
                            <td style="color:white" bgcolor={{($servicio->estado==1)?'#7FFF00':'#DC143C'}}>
                                {{ ($servicio->estado==1)?'Pendiente':'Terminado'}}
                            </td>
                            <td>
                                {{ $servicio->solicitud->cliente->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $servicio->empleado->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $servicio->solicitud->servicio->nombre ?? '' }}
                            </td>

                            <td>

                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.servicios.show', $servicio->idempleadoservicio) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.servicios.edit', $servicio->idempleadoservicio) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('admin.servicios.destroy', $servicio->idempleadoservicio) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
