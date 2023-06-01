<div class="m-3">
    @can('mlog_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.mlogs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.mlog.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.mlog.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-clientMlogs">
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
                    <tbody>
                        @foreach($mlogs as $key => $mlog)
                            <tr data-entry-id="{{ $mlog->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $mlog->id ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->id_mlog ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->client->id_client ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->boat->name ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->wlist->description ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->wlist->status ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->product->name ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->product->description ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->description ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->quantity ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->price_unit ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->discount ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->total ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->status ?? '' }}
                                </td>
                                <td>
                                    @foreach($mlog->tags as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $mlog->proforma_number->proforma_number ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->proforma_number->description ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $mlog->invoiced_line ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $mlog->invoiced_line ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('mlog_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.mlogs.show', $mlog->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('mlog_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.mlogs.edit', $mlog->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('mlog_delete')
                                        <form action="{{ route('admin.mlogs.destroy', $mlog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('mlog_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mlogs.massDestroy') }}",
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
  let table = $('.datatable-clientMlogs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection