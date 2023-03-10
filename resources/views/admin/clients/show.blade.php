@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.client.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id') }}
                        </th>
                        <td>
                            {{ $client->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id_client') }}
                        </th>
                        <td>
                            {{ $client->id_client }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.name') }}
                        </th>
                        <td>
                            {{ $client->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.lastname') }}
                        </th>
                        <td>
                            {{ $client->lastname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.boats') }}
                        </th>
                        <td>
                            @foreach($client->boats as $key => $boats)
                                <span class="label label-info">{{ $boats->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.vat') }}
                        </th>
                        <td>
                            {{ $client->vat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.address') }}
                        </th>
                        <td>
                            {{ $client->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.country') }}
                        </th>
                        <td>
                            {{ $client->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.email') }}
                        </th>
                        <td>
                            {{ $client->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.phone') }}
                        </th>
                        <td>
                            {{ $client->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.mobile') }}
                        </th>
                        <td>
                            {{ $client->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.notes') }}
                        </th>
                        <td>
                            {{ $client->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.internalnotes') }}
                        </th>
                        <td>
                            {{ $client->internalnotes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.defaulter') }}
                        </th>
                        <td>
                            {{ App\Models\Client::DEFAULTER_RADIO[$client->defaulter] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.lastuse') }}
                        </th>
                        <td>
                            {{ $client->lastuse }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.link_fd') }}
                        </th>
                        <td>
                            {{ $client->link_fd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.coordinates') }}
                        </th>
                        <td>
                            {{ $client->coordinates }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
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
            <a class="nav-link" href="#client_wlists" role="tab" data-toggle="tab">
                {{ trans('cruds.wlist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_boats" role="tab" data-toggle="tab">
                {{ trans('cruds.boat.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="client_wlists">
            @includeIf('admin.clients.relationships.clientWlists', ['wlists' => $client->clientWlists])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_boats">
            @includeIf('admin.clients.relationships.clientBoats', ['boats' => $client->clientBoats])
        </div>
    </div>
</div>

@endsection