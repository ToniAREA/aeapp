@extends('layouts.admin')
@section('content')
@can('proforma_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.proformas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.proforma.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Proforma', 'route' => 'admin.proformas.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.proforma.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Proforma">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.proforma_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.lastname') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.boats') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.wlists') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.total_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.currency') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.sent') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.paid') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.claims') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.proforma.fields.notes') }}
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
@can('proforma_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.proformas.massDestroy') }}",
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
    ajax: "{{ route('admin.proformas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'proforma_number', name: 'proforma_number' },
{ data: 'client_name', name: 'client.name' },
{ data: 'client.lastname', name: 'client.lastname' },
{ data: 'boats', name: 'boats.name' },
{ data: 'wlists', name: 'wlists.description' },
{ data: 'date', name: 'date' },
{ data: 'description', name: 'description' },
{ data: 'total_amount', name: 'total_amount' },
{ data: 'currency', name: 'currency' },
{ data: 'sent', name: 'sent' },
{ data: 'paid', name: 'paid' },
{ data: 'claims', name: 'claims' },
{ data: 'link', name: 'link' },
{ data: 'status', name: 'status' },
{ data: 'notes', name: 'notes' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Proforma').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection