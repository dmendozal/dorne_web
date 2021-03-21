@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.clientes.create") }}">
                {{ trans('global.add') }} {{ trans('global.cliente.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('global.cliente.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.cliente.fields.nombre') }}
                        </th>
                        <th>
                            {{ trans('global.cliente.fields.ci') }}
                        </th>
                        <th>
                            {{ trans('global.cliente.fields.email') }}
                        </th>
                        <th>
                            {{ trans('global.cliente.fields.direccion') }}
                        </th>
                        <th>
                            {{ trans('global.cliente.fields.telefono') }}
                        </th>
                        <th>
                            {{ trans('global.cliente.fields.username') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $key => $cliente)
                        <tr data-entry-id="{{ $cliente->idcliente }}">
                            <td>

                            </td>
                            <td>
                                {{ $cliente->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $cliente->ci ?? '' }}
                            </td>
                            <td>
                                {{ $cliente->email ?? '' }}
                            </td>
                            <td>
                                {{ $cliente->direccion ?? '' }}
                            </td>
                            <td>
                                75006936{{--  {{ $cliente->telefono ?? '' }}  --}}
                            </td>
                            <td>
                                {{ $cliente->username ?? '' }}
                            </td>
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.clientes.show', $cliente->idcliente) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.clientes.edit', $cliente->idcliente) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('admin.clientes.destroy', $cliente->idcliente) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
