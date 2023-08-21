@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.boatsType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boats-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.boatsType.fields.id') }}
                        </th>
                        <td>
                            {{ $boatsType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boatsType.fields.type') }}
                        </th>
                        <td>
                            {{ $boatsType->type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boats-types.index') }}">
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
            <a class="nav-link" href="#boat_type_boats" role="tab" data-toggle="tab">
                {{ trans('cruds.boat.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="boat_type_boats">
            @includeIf('admin.boatsTypes.relationships.boatTypeBoats', ['boats' => $boatsType->boatTypeBoats])
        </div>
    </div>
</div>

@endsection