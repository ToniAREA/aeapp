@extends('layouts.admin')
@section('content')
<div class="c-card">
        <div class="c-card-header">
            <b>{{ strtoupper(trans('cruds.wlog.title')) }}</b>
        </div>

        <div class="c-card-body">
            @livewire('search-wlogs')
        </div>
    </div>
<div class="c-card">
    <div class="c-card-header">
        <b>{{ strtoupper(trans('cruds.wlog.title_singular')) }} {{ strtoupper(trans('global.list')) }}</b>
    </div>

    <div class="c-card-body">
         <div class="d-flex justify-content-between">

                @can('wlog_create')
                    <a class="btn btn-outline-success btn-custom flex-fill"
                        href="{{ route('admin.wlogs.create') }}">{{ trans('global.add') }}
                        {{ trans('cruds.wlog.title_singular') }}</a>

                    <button class="btn btn-outline-warning btn-custom flex-fill" data-toggle="modal"
                        data-target="#csvImportModal">{{ trans('global.app_csvImport') }}</button>

                    @include('csvImport.modal', [
                        'model' => 'Wlog',
                        'route' => 'admin.wlogs.parseCsvImport',
                    ])

                @endcan

            </div>
            <br>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Wlog">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.wlist') }}
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
                            {{ trans('cruds.wlog.fields.tags') }}
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
                                {{ $wlog->date ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->wlist->desciption ?? '' }}
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
                                @foreach($wlog->tags as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
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



@endsection
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
  let table = $('.datatable-Wlog:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection