@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('brand_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.brands.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.brand.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Brand', 'route' => 'admin.brands.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.brand.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Brand">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.brand.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.brand.fields.brand') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.brand.fields.brand_logo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.brand.fields.brand_url') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.brand.fields.providers') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.brand.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.brand.fields.internal_notes') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $key => $brand)
                                    <tr data-entry-id="{{ $brand->id }}">
                                        <td>
                                            {{ $brand->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $brand->brand ?? '' }}
                                        </td>
                                        <td>
                                            @if($brand->brand_logo)
                                                <a href="{{ $brand->brand_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $brand->brand_logo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $brand->brand_url ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($brand->providers as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $brand->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $brand->internal_notes ?? '' }}
                                        </td>
                                        <td>
                                            @can('brand_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.brands.show', $brand->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('brand_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.brands.edit', $brand->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('brand_delete')
                                                <form action="{{ route('frontend.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('brand_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.brands.massDestroy') }}",
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
  let table = $('.datatable-Brand:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection