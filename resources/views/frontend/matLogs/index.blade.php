@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('mat_log_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.mat-logs.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-MatLog">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($matLogs as $key => $matLog)
                                    <tr data-entry-id="{{ $matLog->id }}">
                                        <td>
                                            {{ $matLog->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->boat->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->boat->internalnotes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->boat_namecomplete ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->wlist->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->wlist->status ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->employee->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->employee->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->item ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->product->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->product->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->pvp ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->units ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->proforma_number->proforma_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $matLog->proforma_number->description ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $matLog->invoiced_line ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $matLog->invoiced_line ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $matLog->status ?? '' }}
                                        </td>
                                        <td>
                                            @can('mat_log_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.mat-logs.show', $matLog->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('mat_log_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.mat-logs.edit', $matLog->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('mat_log_delete')
                                                <form action="{{ route('frontend.mat-logs.destroy', $matLog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('mat_log_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.mat-logs.massDestroy') }}",
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
  let table = $('.datatable-MatLog:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection