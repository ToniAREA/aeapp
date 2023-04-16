@extends('layouts.admin')
@section('content')
@can('claim_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.claims.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.claim.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.claim.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Claim">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.claim.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.claim.fields.proforma_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.proforma.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.claim.fields.note') }}
                        </th>
                        <th>
                            {{ trans('cruds.claim.fields.claim_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($claims as $key => $claim)
                        <tr data-entry-id="{{ $claim->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $claim->id ?? '' }}
                            </td>
                            <td>
                                {{ $claim->proforma_number->proforma_number ?? '' }}
                            </td>
                            <td>
                                {{ $claim->proforma_number->description ?? '' }}
                            </td>
                            <td>
                                {{ $claim->note ?? '' }}
                            </td>
                            <td>
                                {{ $claim->claim_date ?? '' }}
                            </td>
                            <td>
                                @can('claim_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.claims.show', $claim->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('claim_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.claims.edit', $claim->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('claim_delete')
                                    <form action="{{ route('admin.claims.destroy', $claim->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('claim_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.claims.massDestroy') }}",
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
  let table = $('.datatable-Claim:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection