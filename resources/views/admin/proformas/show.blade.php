@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.proforma.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.proformas.index') }}">
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
                            {{ trans('cruds.proforma.fields.date') }}
                        </th>
                        <td>
                            {{ $proforma->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.wlists') }}
                        </th>
                        <td>
                            @foreach($proforma->wlists as $key => $wlists)
                                <span class="label label-info">{{ $wlists->desciption }}</span>
                            @endforeach
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
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.proformas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#proforma_number_wlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.wlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#proforma_number_mlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.mlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#proforma_number_claims" role="tab" data-toggle="tab">
                {{ trans('cruds.claim.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="proforma_number_wlogs">
            @includeIf('admin.proformas.relationships.proformaNumberWlogs', ['wlogs' => $proforma->proformaNumberWlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="proforma_number_mlogs">
            @includeIf('admin.proformas.relationships.proformaNumberMlogs', ['mlogs' => $proforma->proformaNumberMlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="proforma_number_claims">
            @includeIf('admin.proformas.relationships.proformaNumberClaims', ['claims' => $proforma->proformaNumberClaims])
        </div>
    </div>
</div>

@endsection