@extends('layouts.admin')
@section('content')
@can('contact_contact_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.contact-contacts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.contactContact.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ContactContact', 'route' => 'admin.contact-contacts.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.contactContact.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ContactContact">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_nif') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_address') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_country') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_mobile') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_mobile_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_email_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.social_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_tags') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactContact.fields.contact_internalnotes') }}
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
@can('contact_contact_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.contact-contacts.massDestroy') }}",
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
    ajax: "{{ route('admin.contact-contacts.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'contact_first_name', name: 'contact_first_name' },
{ data: 'contact_last_name', name: 'contact_last_name' },
{ data: 'contact_nif', name: 'contact_nif' },
{ data: 'contact_address', name: 'contact_address' },
{ data: 'contact_country', name: 'contact_country' },
{ data: 'contact_mobile', name: 'contact_mobile' },
{ data: 'contact_mobile_2', name: 'contact_mobile_2' },
{ data: 'contact_email', name: 'contact_email' },
{ data: 'contact_email_2', name: 'contact_email_2' },
{ data: 'social_link', name: 'social_link' },
{ data: 'contact_tags', name: 'contact_tags' },
{ data: 'contact_notes', name: 'contact_notes' },
{ data: 'contact_internalnotes', name: 'contact_internalnotes' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ContactContact').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection