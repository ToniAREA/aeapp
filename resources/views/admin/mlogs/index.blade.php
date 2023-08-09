@extends('layouts.admin')
@section('content')
@can('mlog_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mlogs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mlog.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Mlog', 'route' => 'admin.mlogs.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.mlog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Mlog">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.id_mlog') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.boat') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.wlist') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.price_unit') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.total') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.tags') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.proforma_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.invoiced_line') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('mlog_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mlogs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.mlogs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'id_mlog', name: 'id_mlog' },
{ data: 'client_id_client', name: 'client.id_client' },
{ data: 'boat_name', name: 'boat.name' },
{ data: 'wlist_description', name: 'wlist.description' },
{ data: 'wlist.status', name: 'wlist.status' },
{ data: 'product_name', name: 'product.name' },
{ data: 'product.description', name: 'product.description' },
{ data: 'description', name: 'description' },
{ data: 'quantity', name: 'quantity' },
{ data: 'price_unit', name: 'price_unit' },
{ data: 'discount', name: 'discount' },
{ data: 'total', name: 'total' },
{ data: 'status', name: 'status' },
{ data: 'tags', name: 'tags.name' },
{ data: 'proforma_number_proforma_number', name: 'proforma_number.proforma_number' },
{ data: 'proforma_number.description', name: 'proforma_number.description' },
{ data: 'invoiced_line', name: 'invoiced_line' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Mlog').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection