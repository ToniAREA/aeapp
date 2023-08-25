@extends('layouts.admin')
@section('content')
@can('to_do_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.to-dos.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.toDo.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.toDo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ToDo">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.toDo.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.toDo.fields.for_role') }}
                    </th>
                    <th>
                        {{ trans('cruds.toDo.fields.for_user') }}
                    </th>
                    <th>
                        {{ trans('cruds.toDo.fields.task') }}
                    </th>
                    <th>
                        {{ trans('cruds.toDo.fields.photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.toDo.fields.deadline') }}
                    </th>
                    <th>
                        {{ trans('cruds.toDo.fields.priority') }}
                    </th>
                    <th>
                        {{ trans('cruds.priority.fields.weight') }}
                    </th>
                    <th>
                        {{ trans('cruds.toDo.fields.notes') }}
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
@can('to_do_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.to-dos.massDestroy') }}",
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
    ajax: "{{ route('admin.to-dos.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'for_role', name: 'for_roles.title' },
{ data: 'for_user', name: 'for_users.name' },
{ data: 'task', name: 'task' },
{ data: 'photo', name: 'photo', sortable: false, searchable: false },
{ data: 'deadline', name: 'deadline' },
{ data: 'priority_name', name: 'priority.name' },
{ data: 'priority.weight', name: 'priority.weight' },
{ data: 'notes', name: 'notes' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ToDo').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection