@extends('layouts.admin')
@section('content')
@can('mat_log_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mat-logs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.matLog.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'MatLog', 'route' => 'admin.mat-logs.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.matLog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MatLog">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.boat') }}
                    </th>
                    <th>
                        {{ trans('cruds.boat.fields.internalnotes') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.boat_namecomplete') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.wlist') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.employee') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.item') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.pvp') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.units') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.proforma_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.invoiced_line') }}
                    </th>
                    <th>
                        {{ trans('cruds.matLog.fields.status') }}
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
@can('mat_log_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mat-logs.massDestroy') }}",
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
    ajax: "{{ route('admin.mat-logs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'boat_name', name: 'boat.name' },
{ data: 'boat.internalnotes', name: 'boat.internalnotes' },
{ data: 'boat_namecomplete', name: 'boat_namecomplete' },
{ data: 'wlist_description', name: 'wlist.description' },
{ data: 'wlist.status', name: 'wlist.status' },
{ data: 'date', name: 'date' },
{ data: 'employee_name', name: 'employee.name' },
{ data: 'employee.email', name: 'employee.email' },
{ data: 'item', name: 'item' },
{ data: 'product_name', name: 'product.name' },
{ data: 'product.description', name: 'product.description' },
{ data: 'description', name: 'description' },
{ data: 'pvp', name: 'pvp' },
{ data: 'units', name: 'units' },
{ data: 'proforma_number_proforma_number', name: 'proforma_number.proforma_number' },
{ data: 'proforma_number.description', name: 'proforma_number.description' },
{ data: 'invoiced_line', name: 'invoiced_line' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-MatLog').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection