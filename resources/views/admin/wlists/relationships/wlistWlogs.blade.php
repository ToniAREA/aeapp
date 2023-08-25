<div class="m-3">
    @can('wlog_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.wlogs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.wlog.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.wlog.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-wlistWlogs">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.wlist') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.boat_namecomplete') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.date') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.employee') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.marina') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.hours') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.proforma_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.proforma.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.invoiced_line') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlog.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wlogs as $key => $wlog)
                            <tr data-entry-id="{{ $wlog->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $wlog->id ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->wlist->description ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->wlist->status ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->boat_namecomplete ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->date ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->employee->name ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->employee->email ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->marina->name ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->description ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->hours ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->proforma_number->proforma_number ?? '' }}
                                </td>
                                <td>
                                    {{ $wlog->proforma_number->description ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $wlog->invoiced_line ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $wlog->invoiced_line ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $wlog->status ?? '' }}
                                </td>
                                <td>
                                    @can('wlog_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.wlogs.show', $wlog->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('wlog_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.wlogs.edit', $wlog->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('wlog_delete')
                                        <form action="{{ route('admin.wlogs.destroy', $wlog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('wlog_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.wlogs.massDestroy') }}",
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
  let table = $('.datatable-wlistWlogs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection