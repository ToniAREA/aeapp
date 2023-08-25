@extends('layouts.admin')
@section('content')
@can('wlist_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.wlists.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.wlist.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Wlist', 'route' => 'admin.wlists.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.wlist.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Wlist">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.lastname') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.boat') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.order_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.for_role') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.for_user') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.boat_namecomplete') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.photos') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.deadline') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.priority') }}
                    </th>
                    <th>
                        {{ trans('cruds.priority.fields.weight') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.url_invoice') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.notes') }}
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
@can('wlist_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.wlists.massDestroy') }}",
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
    ajax: "{{ route('admin.wlists.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'client_name', name: 'client.name' },
{ data: 'client.lastname', name: 'client.lastname' },
{ data: 'boat_name', name: 'boat.name' },
{ data: 'order_type', name: 'order_type' },
{ data: 'for_role', name: 'for_roles.title' },
{ data: 'for_user', name: 'for_users.name' },
{ data: 'boat_namecomplete', name: 'boat_namecomplete' },
{ data: 'description', name: 'description' },
{ data: 'photos', name: 'photos', sortable: false, searchable: false },
{ data: 'deadline', name: 'deadline' },
{ data: 'priority_name', name: 'priority.name' },
{ data: 'priority.weight', name: 'priority.weight' },
{ data: 'status', name: 'status' },
{ data: 'url_invoice', name: 'url_invoice' },
{ data: 'notes', name: 'notes' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Wlist').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection