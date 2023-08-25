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
                            {{ trans('cruds.boat.fields.ref') }}
                        </th>
                        <td>
                            {{ $boat->ref }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.boat_type') }}
                        </th>
                        <td>
                            {{ $boat->boat_type }}
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
                            {{ trans('cruds.boat.fields.imo') }}
                        </th>
                        <td>
                            {{ $boat->imo }}
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
                            {{ trans('cruds.boat.fields.marina') }}
                        </th>
                        <td>
                            {{ $boat->marina->name ?? '' }}
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
                            {{ trans('cruds.boat.fields.clients') }}
                        </th>
                        <td>
                            @foreach($boat->clients as $key => $clients)
                                <span class="label label-info">{{ $clients->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.coordinates') }}
                        </th>
                        <td>
                            {{ $boat->coordinates }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.link') }}
                        </th>
                        <td>
                            {{ $boat->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.last_use') }}
                        </th>
                        <td>
                            {{ $boat->last_use }}
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
            <a class="nav-link" href="#boat_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boat_mat_logs" role="tab" data-toggle="tab">
                {{ trans('cruds.matLog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boats_clients" role="tab" data-toggle="tab">
                {{ trans('cruds.client.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boats_proformas" role="tab" data-toggle="tab">
                {{ trans('cruds.proforma.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="boat_wlists">
            @includeIf('admin.boats.relationships.boatWlists', ['wlists' => $boat->boatWlists])
        </div>
        <div class="tab-pane" role="tabpanel" id="boat_appointments">
            @includeIf('admin.boats.relationships.boatAppointments', ['appointments' => $boat->boatAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="boat_mat_logs">
            @includeIf('admin.boats.relationships.boatMatLogs', ['matLogs' => $boat->boatMatLogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="boats_clients">
            @includeIf('admin.boats.relationships.boatsClients', ['clients' => $boat->boatsClients])
        </div>
        <div class="tab-pane" role="tabpanel" id="boats_proformas">
            @includeIf('admin.boats.relationships.boatsProformas', ['proformas' => $boat->boatsProformas])
        </div>
    </div>
</div>

@endsection