<div class="m-3">
    @can('appointment_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.appointments.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.appointment.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.appointment.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-forRoleAppointments">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.lastname') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.boat') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.wlists') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.for_role') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.for_user') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.boat_namecomplete') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.when_starts') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.when_ends') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.priority') }}
                            </th>
                            <th>
                                {{ trans('cruds.priority.fields.weight') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.notes') }}
                            </th>
                            <th>
                                {{ trans('cruds.appointment.fields.coordinates') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $key => $appointment)
                            <tr data-entry-id="{{ $appointment->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $appointment->id ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->client->lastname ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->boat->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($appointment->wlists as $key => $item)
                                        <span class="badge badge-info">{{ $item->description }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($appointment->for_roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($appointment->for_users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $appointment->boat_namecomplete ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->description ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->when_starts ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->when_ends ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->priority->name ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->priority->weight ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->status ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->notes ?? '' }}
                                </td>
                                <td>
                                    {{ $appointment->coordinates ?? '' }}
                                </td>
                                <td>
                                    @can('appointment_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.appointments.show', $appointment->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('appointment_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.appointments.edit', $appointment->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('appointment_delete')
                                        <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('appointment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.appointments.massDestroy') }}",
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
  let table = $('.datatable-forRoleAppointments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection