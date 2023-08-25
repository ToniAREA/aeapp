@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.wlist.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.wlists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.id') }}
                        </th>
                        <td>
                            {{ $wlist->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.client') }}
                        </th>
                        <td>
                            {{ $wlist->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.boat') }}
                        </th>
                        <td>
                            {{ $wlist->boat->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.order_type') }}
                        </th>
                        <td>
                            {{ App\Models\Wlist::ORDER_TYPE_RADIO[$wlist->order_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.for_role') }}
                        </th>
                        <td>
                            @foreach($wlist->for_roles as $key => $for_role)
                                <span class="label label-info">{{ $for_role->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.for_user') }}
                        </th>
                        <td>
                            @foreach($wlist->for_users as $key => $for_user)
                                <span class="label label-info">{{ $for_user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.boat_namecomplete') }}
                        </th>
                        <td>
                            {{ $wlist->boat_namecomplete }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.description') }}
                        </th>
                        <td>
                            {{ $wlist->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.photos') }}
                        </th>
                        <td>
                            @foreach($wlist->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.deadline') }}
                        </th>
                        <td>
                            {{ $wlist->deadline }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.priority') }}
                        </th>
                        <td>
                            {{ $wlist->priority->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.status') }}
                        </th>
                        <td>
                            {{ $wlist->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.url_invoice') }}
                        </th>
                        <td>
                            {{ $wlist->url_invoice }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wlist.fields.notes') }}
                        </th>
                        <td>
                            {{ $wlist->notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.wlists.index') }}">
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
            <a class="nav-link" href="#wlist_wlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.wlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#wlist_mat_logs" role="tab" data-toggle="tab">
                {{ trans('cruds.matLog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#wlists_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#wlists_proformas" role="tab" data-toggle="tab">
                {{ trans('cruds.proforma.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="wlist_wlogs">
            @includeIf('admin.wlists.relationships.wlistWlogs', ['wlogs' => $wlist->wlistWlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="wlist_mat_logs">
            @includeIf('admin.wlists.relationships.wlistMatLogs', ['matLogs' => $wlist->wlistMatLogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="wlists_appointments">
            @includeIf('admin.wlists.relationships.wlistsAppointments', ['appointments' => $wlist->wlistsAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="wlists_proformas">
            @includeIf('admin.wlists.relationships.wlistsProformas', ['proformas' => $wlist->wlistsProformas])
        </div>
    </div>
</div>

@endsection