@extends('layouts.admin')
@section('content')
@can('client_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.clients.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.client.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Client', 'route' => 'admin.clients.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.client.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Client">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.client.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.defaulter') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.ref') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.lastname') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.vat') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.country') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.telephone') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.mobile') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.company') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.contacts') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.boats') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.internalnotes') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.coordinates') }}
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
@can('client_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.clients.massDestroy') }}",
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
    ajax: "{{ route('admin.clients.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'defaulter', name: 'defaulter' },
{ data: 'ref', name: 'ref' },
{ data: 'name', name: 'name' },
{ data: 'lastname', name: 'lastname' },
{ data: 'vat', name: 'vat' },
{ data: 'address', name: 'address' },
{ data: 'country', name: 'country' },
{ data: 'telephone', name: 'telephone' },
{ data: 'mobile', name: 'mobile' },
{ data: 'email', name: 'email' },
{ data: 'company_company_name', name: 'company.company_name' },
{ data: 'company.company_email', name: 'company.company_email' },
{ data: 'contacts', name: 'contacts.contact_first_name' },
{ data: 'boats', name: 'boats.name' },
{ data: 'notes', name: 'notes' },
{ data: 'internalnotes', name: 'internalnotes' },
{ data: 'link', name: 'link' },
{ data: 'coordinates', name: 'coordinates' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Client').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection