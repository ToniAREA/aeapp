@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.marina.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.marinas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.id') }}
                        </th>
                        <td>
                            {{ $marina->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.name') }}
                        </th>
                        <td>
                            {{ $marina->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.coordinates') }}
                        </th>
                        <td>
                            {{ $marina->coordinates }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.link') }}
                        </th>
                        <td>
                            {{ $marina->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.notes') }}
                        </th>
                        <td>
                            {{ $marina->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.internal_notes') }}
                        </th>
                        <td>
                            {{ $marina->internal_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.last_use') }}
                        </th>
                        <td>
                            {{ $marina->last_use }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.marinas.index') }}">
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
            <a class="nav-link" href="#marina_boats" role="tab" data-toggle="tab">
                {{ trans('cruds.boat.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#marina_wlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.wlog.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="marina_boats">
            @includeIf('admin.marinas.relationships.marinaBoats', ['boats' => $marina->marinaBoats])
        </div>
        <div class="tab-pane" role="tabpanel" id="marina_wlogs">
            @includeIf('admin.marinas.relationships.marinaWlogs', ['wlogs' => $marina->marinaWlogs])
        </div>
    </div>
</div>

@endsection