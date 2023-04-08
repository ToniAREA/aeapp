@extends('layouts.admin')
@section('content')
    <div class="c-card">
        <div class="c-card-header">
            <b>{{ strtoupper(trans('cruds.employee.title_singular')) }} {{ strtoupper(trans('global.list')) }}</b>
        </div>

        <div class="c-card-body">

            <div class="d-flex justify-content-between">

                @can('employee_create')
                    <a class="btn btn-outline-success btn-custom flex-fill"
                        href="{{ route('admin.employees.create') }}">{{ trans('global.add') }}
                        {{ trans('cruds.employee.title_singular') }}</a>

                    <button class="btn btn-outline-warning btn-custom flex-fill" data-toggle="modal"
                        data-target="#csvImportModal">{{ trans('global.app_csvImport') }}</button>

                    @include('csvImport.modal', [
                        'model' => 'Employee',
                        'route' => 'admin.employees.parseCsvImport',
                    ])

                @endcan

            </div>
            <br>

            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Employee">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.id_employee') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.contact') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.contract_starts') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.contract_ends') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.notes') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.internalnotes') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $key => $employee)
                            <tr data-entry-id="{{ $employee->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $employee->id ?? '' }}
                                </td>
                                <td>
                                    {{ $employee->id_employee ?? '' }}
                                </td>
                                <td>
                                    {{ $employee->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $employee->user->email ?? '' }}
                                </td>
                                <td>
                                    {{ $employee->contact->contact_first_name ?? '' }}
                                </td>
                                <td>
                                    @if ($employee->photo)
                                        <a href="{{ $employee->photo->getUrl() }}" target="_blank"
                                            style="display: inline-block">
                                            <img src="{{ $employee->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $employee->status ?? '' }}
                                </td>
                                <td>
                                    {{ $employee->contract_starts ?? '' }}
                                </td>
                                <td>
                                    {{ $employee->contract_ends ?? '' }}
                                </td>
                                <td>
                                    {{ $employee->notes ?? '' }}
                                </td>
                                <td>
                                    {{ $employee->internalnotes ?? '' }}
                                </td>
                                <td>
                                    @can('employee_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.employees.show', $employee->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('employee_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.employees.edit', $employee->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('employee_delete')
                                        <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST"
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
            @can('employee_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.employees.massDestroy') }}",
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
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Employee:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
