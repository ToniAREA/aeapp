@extends('layouts.admin')
@section('content')
@can('wlist_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.wlists.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.wlist.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Wlist', 'route' => 'admin.wlists.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.wlist.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Wlist">
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
                            {{ trans('cruds.wlist.fields.boat') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlist.fields.desciption') }}
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
                            {{ trans('cruds.wlist.fields.for_role') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlist.fields.for_user') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlist.fields.wlogs') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    {{-- <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($clients as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($boats as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($priorities as $key => $item)
                                    <option value="{{ $item->level }}">{{ $item->level }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($roles as $key => $item)
                                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($wlogs as $key => $item)
                                    <option value="{{ $item->date }}">{{ $item->date }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr> --}}
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
                                {{ $wlist->boat->name ?? '' }}
                            </td>
                            <td>
                                {{ $wlist->desciption ?? '' }}
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
                                {{ $wlist->priority->level ?? '' }}
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
                                @foreach($wlist->wlogs as $key => $item)
                                    <span class="badge badge-info">{{ $item->date }}</span>
                                @endforeach
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



@endsection
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
  let table = $('.datatable-Wlist:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection