@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.matLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mat-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.id') }}
                        </th>
                        <td>
                            {{ $matLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.boat') }}
                        </th>
                        <td>
                            {{ $matLog->boat->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.boat_namecomplete') }}
                        </th>
                        <td>
                            {{ $matLog->boat_namecomplete }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.wlist') }}
                        </th>
                        <td>
                            {{ $matLog->wlist->description ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.date') }}
                        </th>
                        <td>
                            {{ $matLog->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.employee') }}
                        </th>
                        <td>
                            {{ $matLog->employee->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.item') }}
                        </th>
                        <td>
                            {{ $matLog->item }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.product') }}
                        </th>
                        <td>
                            {{ $matLog->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.description') }}
                        </th>
                        <td>
                            {{ $matLog->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.pvp') }}
                        </th>
                        <td>
                            {{ $matLog->pvp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.units') }}
                        </th>
                        <td>
                            {{ $matLog->units }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.proforma_number') }}
                        </th>
                        <td>
                            {{ $matLog->proforma_number->proforma_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.invoiced_line') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $matLog->invoiced_line ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.matLog.fields.status') }}
                        </th>
                        <td>
                            {{ $matLog->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mat-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection