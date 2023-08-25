<div class="m-3">
    @can('boat_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.boats.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.boat.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.boat.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-clientsBoats">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.ref') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.boat_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.imo') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.mmsi') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.marina') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.notes') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.internalnotes') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.clients') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.coordinates') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.link') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.last_use') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boats as $key => $boat)
                            <tr data-entry-id="{{ $boat->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $boat->id ?? '' }}
                                </td>
                                <td>
                                    {{ $boat->ref ?? '' }}
                                </td>
                                <td>
                                    {{ $boat->boat_type ?? '' }}
                                </td>
                                <td>
                                    {{ $boat->name ?? '' }}
                                </td>
                                <td>
                                    {{ $boat->imo ?? '' }}
                                </td>
                                <td>
                                    {{ $boat->mmsi ?? '' }}
                                </td>
                                <td>
                                    {{ $boat->marina->name ?? '' }}
                                </td>
                                <td>
                                    {{ $boat->notes ?? '' }}
                                </td>
                                <td>
                                    {{ $boat->internalnotes ?? '' }}
                                </td>
                                <td>
                                    @foreach($boat->clients as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $boat->coordinates ?? '' }}
                                </td>
                                <td>
                                    {{ $boat->link ?? '' }}
                                </td>
                                <td>
                                    {{ $boat->last_use ?? '' }}
                                </td>
                                <td>
                                    @can('boat_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.boats.show', $boat->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('boat_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.boats.edit', $boat->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('boat_delete')
                                        <form action="{{ route('admin.boats.destroy', $boat->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('boat_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.boats.massDestroy') }}",
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
  let table = $('.datatable-clientsBoats:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection