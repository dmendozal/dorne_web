@extends('layouts.admin')
@section('content')

<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.solicitud.create") }}">
                {{ trans('global.add') }} {{ trans('global.solicitud.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('global.solicitud.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.solicitud.fields.descripcion') }}
                        </th>
                        <th>
                            {{ trans('global.solicitud.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('global.solicitud.fields.fecha') }}
                        </th>
                        <th>
                            {{ trans('global.solicitud.fields.cliente') }}
                        </th>
                        <th>
                            {{ trans('global.solicitud.fields.servicio') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitud as $key => $solicitud)
                        <tr data-entry-id="{{ $solicitud->idasignarservicio }}">
                            <td>
                            </td>
                            <td>
                                {{ $solicitud->descripcion ?? '' }}
                            </td>
                            <td style="color:white" bgcolor={{($solicitud->estado=='A')?'#7FFF00':'#DC143C'}}> {{-- Servicio En espera = E     //   Servicio Asignado = A   --}}
                                {{ ($solicitud->estado=='A')?'Asignado':'En espera'}}
                            </td>
                            <td>
                                {{ $solicitud->fecha ?? '' }}
                            </td>
                            <td>
                                {{ $solicitud->cliente->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $solicitud->servicio->nombre ?? '' }}
                            </td>
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.solicitud.show', $solicitud->idasignarservicio) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.solicitud.edit', $solicitud->idasignarservicio) }}">
                                        {{ trans('global.asignar') }}
                                    </a>
                                    @can('product_create')
                                    <form action="{{ route('admin.solicitud.destroy', $solicitud->idasignarservicio) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                    @endcan
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
