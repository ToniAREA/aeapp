@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.boat.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.id') }}
                        </th>
                        <td>
                            {{ $boat->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.id_boat') }}
                        </th>
                        <td>
                            {{ $boat->id_boat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.type') }}
                        </th>
                        <td>
                            {{ $boat->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.name') }}
                        </th>
                        <td>
                            {{ $boat->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.mmsi') }}
                        </th>
                        <td>
                            {{ $boat->mmsi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.notes') }}
                        </th>
                        <td>
                            {{ $boat->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.internalnotes') }}
                        </th>
                        <td>
                            {{ $boat->internalnotes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.lastuse') }}
                        </th>
                        <td>
                            {{ $boat->lastuse }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boats.index') }}">
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
            <a class="nav-link" href="#boat_wlists" role="tab" data-toggle="tab">
                {{ trans('cruds.wlist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boats_clients" role="tab" data-toggle="tab">
                {{ trans('cruds.client.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boats_marinas" role="tab" data-toggle="tab">
                {{ trans('cruds.marina.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="boat_wlists">
            @includeIf('admin.boats.relationships.boatWlists', ['wlists' => $boat->boatWlists])
        </div>
        <div class="tab-pane" role="tabpanel" id="boats_clients">
            @includeIf('admin.boats.relationships.boatsClients', ['clients' => $boat->boatsClients])
        </div>
        <div class="tab-pane" role="tabpanel" id="boats_marinas">
            @includeIf('admin.boats.relationships.boatsMarinas', ['marinas' => $boat->boatsMarinas])
        </div>
    </div>
</div>

@endsection