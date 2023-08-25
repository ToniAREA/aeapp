@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('marina_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.marinas.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.marina.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Marina', 'route' => 'admin.marinas.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.marina.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Marina">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.coordinates') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.link') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.internal_notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.last_use') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($marinas as $key => $marina)
                                    <tr data-entry-id="{{ $marina->id }}">
                                        <td>
                                            {{ $marina->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->coordinates ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->link ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->internal_notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->last_use ?? '' }}
                                        </td>
                                        <td>
                                            @can('marina_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.marinas.show', $marina->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('marina_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.marinas.edit', $marina->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('marina_delete')
                                                <form action="{{ route('frontend.marinas.destroy', $marina->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('marina_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.marinas.massDestroy') }}",
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
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Marina:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection