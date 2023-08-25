@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.toDo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.to-dos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.toDo.fields.id') }}
                        </th>
                        <td>
                            {{ $toDo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toDo.fields.for_role') }}
                        </th>
                        <td>
                            @foreach($toDo->for_roles as $key => $for_role)
                                <span class="label label-info">{{ $for_role->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toDo.fields.for_user') }}
                        </th>
                        <td>
                            @foreach($toDo->for_users as $key => $for_user)
                                <span class="label label-info">{{ $for_user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toDo.fields.task') }}
                        </th>
                        <td>
                            {{ $toDo->task }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toDo.fields.photo') }}
                        </th>
                        <td>
                            @foreach($toDo->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toDo.fields.deadline') }}
                        </th>
                        <td>
                            {{ $toDo->deadline }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toDo.fields.priority') }}
                        </th>
                        <td>
                            {{ $toDo->priority->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toDo.fields.notes') }}
                        </th>
                        <td>
                            {{ $toDo->notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.to-dos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection