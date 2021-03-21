@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.reporte.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.reporte.fields.empleado') }} 
                        </th>
                        <th>
                            {{ trans('global.reporte.fields.entrada') }}
                        </th>
                        <th>
                            {{ trans('global.reporte.fields.salida') }}
                        </th>
                        <th>
                            {{ trans('global.reporte.fields.horas_trabajar') }} (Hrs)
                        </th>
                        <th>
                            {{ trans('global.reporte.fields.horas_trabajadas') }} (Hrs)
                        </th>
                        <th>
                            {{ trans('global.reporte.fields.horas_extras') }} (Hrs)
                        </th>

                    </tr>
                </thead>
                <tbody>
                     @foreach($finally as $key => $finallys)
                        <tr data-entry-id="{{ $key }}">
                            <td>
                            </td>
                            <td>
                                {{ $finally[$key]['empleado'] ?? '' }}
                            </td>
                            <td>
                                {{ $finally[$key]['entrada'] ?? '' }}
                            </td>
                            <td >
                                {{ $finally[$key]['salida'] ?? ''}}
                            </td>
                            <td>
                                {{ $finally[$key]['horaATra'] ?? '' }}
                            </td>
                            <td>
                                {{ $finally[$key]['horaTra'] ?? '' }}
                            </td>
                            <td>
                                {{ $finally[$key]['horExtras'] ?? '' }}
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
