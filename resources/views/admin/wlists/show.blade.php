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
                            {{ trans('cruds.wlist.fields.desciption') }}
                        </th>
                        <td>
                            {{ $wlist->desciption }}
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
                            {{ $wlist->priority->level ?? '' }}
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
                            {{ trans('cruds.wlist.fields.wlogs') }}
                        </th>
                        <td>
                            @foreach($wlist->wlogs as $key => $wlogs)
                                <span class="label label-info">{{ $wlogs->date }}</span>
                            @endforeach
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
            <a class="nav-link" href="#wlist_mlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.mlog.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="wlist_wlogs">
            @includeIf('admin.wlists.relationships.wlistWlogs', ['wlogs' => $wlist->wlistWlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="wlist_mlogs">
            @includeIf('admin.wlists.relationships.wlistMlogs', ['mlogs' => $wlist->wlistMlogs])
        </div>
    </div>
</div>

@endsection