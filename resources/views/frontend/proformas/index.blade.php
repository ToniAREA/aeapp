@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('proforma_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.proformas.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Proforma">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($proformas as $key => $proforma)
                                    <tr data-entry-id="{{ $proforma->id }}">
                                        <td>
                                            {{ $proforma->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proforma->proforma_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proforma->client->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proforma->client->lastname ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($proforma->boats as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($proforma->wlists as $key => $item)
                                                <span>{{ $item->description }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $proforma->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proforma->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proforma->total_amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proforma->currency ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $proforma->sent ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $proforma->sent ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $proforma->paid ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $proforma->paid ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $proforma->claims ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proforma->link ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proforma->status ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proforma->notes ?? '' }}
                                        </td>
                                        <td>
                                            @can('proforma_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.proformas.show', $proforma->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('proforma_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.proformas.edit', $proforma->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('proforma_delete')
                                                <form action="{{ route('frontend.proformas.destroy', $proforma->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('proforma_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.proformas.massDestroy') }}",
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
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Proforma:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection