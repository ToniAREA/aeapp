@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mlog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mlogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.id') }}
                        </th>
                        <td>
                            {{ $mlog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.id_mlog') }}
                        </th>
                        <td>
                            {{ $mlog->id_mlog }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.client') }}
                        </th>
                        <td>
                            {{ $mlog->client->id_client ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.boat') }}
                        </th>
                        <td>
                            {{ $mlog->boat->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.wlist') }}
                        </th>
                        <td>
                            {{ $mlog->wlist->description ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.product') }}
                        </th>
                        <td>
                            {{ $mlog->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.description') }}
                        </th>
                        <td>
                            {{ $mlog->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.quantity') }}
                        </th>
                        <td>
                            {{ $mlog->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.price_unit') }}
                        </th>
                        <td>
                            {{ $mlog->price_unit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.discount') }}
                        </th>
                        <td>
                            {{ $mlog->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.total') }}
                        </th>
                        <td>
                            {{ $mlog->total }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.status') }}
                        </th>
                        <td>
                            {{ $mlog->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.tags') }}
                        </th>
                        <td>
                            @foreach($mlog->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.proforma_number') }}
                        </th>
                        <td>
                            {{ $mlog->proforma_number->proforma_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.invoiced_line') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $mlog->invoiced_line ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mlogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection