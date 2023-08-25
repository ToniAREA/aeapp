@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.proforma.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.proformas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $proforma->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.proforma_number') }}
                                    </th>
                                    <td>
                                        {{ $proforma->proforma_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.client') }}
                                    </th>
                                    <td>
                                        {{ $proforma->client->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.boats') }}
                                    </th>
                                    <td>
                                        @foreach($proforma->boats as $key => $boats)
                                            <span class="label label-info">{{ $boats->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.wlists') }}
                                    </th>
                                    <td>
                                        @foreach($proforma->wlists as $key => $wlists)
                                            <span class="label label-info">{{ $wlists->description }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $proforma->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $proforma->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.total_amount') }}
                                    </th>
                                    <td>
                                        {{ $proforma->total_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.currency') }}
                                    </th>
                                    <td>
                                        {{ $proforma->currency }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.sent') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $proforma->sent ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.paid') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $proforma->paid ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.claims') }}
                                    </th>
                                    <td>
                                        {{ $proforma->claims }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $proforma->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $proforma->status }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proforma.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $proforma->notes }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.proformas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection