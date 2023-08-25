@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.priority.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.priorities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.priority.fields.id') }}
                        </th>
                        <td>
                            {{ $priority->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priority.fields.name') }}
                        </th>
                        <td>
                            {{ $priority->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priority.fields.weight') }}
                        </th>
                        <td>
                            {{ $priority->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priority.fields.slug') }}
                        </th>
                        <td>
                            {{ $priority->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.priorities.index') }}">
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
            <a class="nav-link" href="#priority_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#priority_wlists" role="tab" data-toggle="tab">
                {{ trans('cruds.wlist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#priority_to_dos" role="tab" data-toggle="tab">
                {{ trans('cruds.toDo.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="priority_appointments">
            @includeIf('admin.priorities.relationships.priorityAppointments', ['appointments' => $priority->priorityAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="priority_wlists">
            @includeIf('admin.priorities.relationships.priorityWlists', ['wlists' => $priority->priorityWlists])
        </div>
        <div class="tab-pane" role="tabpanel" id="priority_to_dos">
            @includeIf('admin.priorities.relationships.priorityToDos', ['toDos' => $priority->priorityToDos])
        </div>
    </div>
</div>

@endsection