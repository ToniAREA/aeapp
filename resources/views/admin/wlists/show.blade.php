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
                            {{ trans('cruds.wlist.fields.desciption') }}
                        </th>
                        <td>
                            {{ $wlist->desciption }}
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
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="wlist_wlogs">
            @includeIf('admin.wlists.relationships.wlistWlogs', ['wlogs' => $wlist->wlistWlogs])
        </div>
    </div>
</div>

@endsection