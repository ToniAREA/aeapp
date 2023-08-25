<div class="m-3">
    @can('wlist_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.wlists.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.wlist.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.wlist.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-forUserWlists">
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
                    <tbody>
                        @foreach($wlists as $key => $wlist)
                            <tr data-entry-id="{{ $wlist->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $wlist->id ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->client->lastname ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->boat->name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Wlist::ORDER_TYPE_RADIO[$wlist->order_type] ?? '' }}
                                </td>
                                <td>
                                    @foreach($wlist->for_roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($wlist->for_users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $wlist->boat_namecomplete ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->description ?? '' }}
                                </td>
                                <td>
                                    @foreach($wlist->photos as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $wlist->deadline ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->priority->name ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->priority->weight ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->status ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->url_invoice ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->notes ?? '' }}
                                </td>
                                <td>
                                    @can('wlist_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.wlists.show', $wlist->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('wlist_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.wlists.edit', $wlist->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('wlist_delete')
                                        <form action="{{ route('admin.wlists.destroy', $wlist->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('wlist_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.wlists.massDestroy') }}",
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
  let table = $('.datatable-forUserWlists:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection