@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.role.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.roles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.id') }}
                        </th>
                        <td>
                            {{ $role->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.title') }}
                        </th>
                        <td>
                            {{ $role->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                        <td>
                            @foreach($role->permissions as $key => $permissions)
                                <span class="label label-info">{{ $permissions->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.roles.index') }}">
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
            <a class="nav-link" href="#for_role_to_dos" role="tab" data-toggle="tab">
                {{ trans('cruds.toDo.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#for_role_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#for_role_wlists" role="tab" data-toggle="tab">
                {{ trans('cruds.wlist.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="for_role_to_dos">
            @includeIf('admin.roles.relationships.forRoleToDos', ['toDos' => $role->forRoleToDos])
        </div>
        <div class="tab-pane" role="tabpanel" id="for_role_appointments">
            @includeIf('admin.roles.relationships.forRoleAppointments', ['appointments' => $role->forRoleAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="for_role_wlists">
            @includeIf('admin.roles.relationships.forRoleWlists', ['wlists' => $role->forRoleWlists])
        </div>
    </div>
</div>

@endsection