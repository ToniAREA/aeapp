@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @livewire('search-clients')
        </div>
    </div>

    <div class="c-card">

        <div class="c-card-header">
            <b>{{ strtoupper(trans('cruds.client.title_singular')) . ' ' . strtoupper(trans('global.list')) }}</b>
        </div>

        <div class="c-card-body">
            <div class="d-flex justify-content-between">

                @can('client_create')
                    <a class="btn btn-outline-success btn-custom flex-fill"
                        href="{{ route('admin.clients.create') }}">{{ trans('global.add') }}
                        {{ trans('cruds.client.title_singular') }}</a>

                    <button class="btn btn-outline-warning btn-custom flex-fill" data-toggle="modal"
                        data-target="#csvImportModal">{{ trans('global.app_csvImport') }}</button>

                    @include('csvImport.modal', [
                        'model' => 'Client',
                        'route' => 'admin.clients.parseCsvImport',
                    ])
                @endcan

            </div>
            <br>
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Client">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.client.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.id_client') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.lastname') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.boats') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.vat') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.address') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.country') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.mobile') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.notes') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.internalnotes') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.defaulter') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.lastuse') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.link_fd') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.coordinates') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $key => $client)
                            <tr data-entry-id="{{ $client->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $client->id ?? '' }}
                                </td>
                                <td>
                                    {{ $client->id_client ?? '' }}
                                </td>
                                <td>
                                    {{ $client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $client->lastname ?? '' }}
                                </td>
                                <td>
                                    @foreach ($client->boats as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $client->vat ?? '' }}
                                </td>
                                <td>
                                    {{ $client->address ?? '' }}
                                </td>
                                <td>
                                    {{ $client->country ?? '' }}
                                </td>
                                <td>
                                    {{ $client->email ?? '' }}
                                </td>
                                <td>
                                    {{ $client->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $client->mobile ?? '' }}
                                </td>
                                <td>
                                    {{ $client->notes ?? '' }}
                                </td>
                                <td>
                                    {{ $client->internalnotes ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Client::DEFAULTER_RADIO[$client->defaulter] ?? '' }}
                                </td>
                                <td>
                                    {{ $client->lastuse ?? '' }}
                                </td>
                                <td>
                                    {{ $client->link_fd ?? '' }}
                                </td>
                                <td>
                                    {{ $client->coordinates ?? '' }}
                                </td>
                                <td>
                                    @can('client_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.clients.show', $client->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('client_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.clients.edit', $client->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('client_delete')
                                        <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('client_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.clients.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [2, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Client:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
