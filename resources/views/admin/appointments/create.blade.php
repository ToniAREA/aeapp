@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="boat_id">{{ trans('cruds.appointment.fields.boat') }}</label>
                <select class="form-control select2 {{ $errors->has('boat') ? 'is-invalid' : '' }}" name="boat_id" id="boat_id">
                    @foreach($boats as $id => $entry)
                        <option value="{{ $id }}" {{ old('boat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('boat'))
                    <span class="text-danger">{{ $errors->first('boat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.boat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wlists">{{ trans('cruds.appointment.fields.wlists') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('wlists') ? 'is-invalid' : '' }}" name="wlists[]" id="wlists" multiple>
                    @foreach($wlists as $id => $wlist)
                        <option value="{{ $id }}" {{ in_array($id, old('wlists', [])) ? 'selected' : '' }}>{{ $wlist }}</option>
                    @endforeach
                </select>
                @if($errors->has('wlists'))
                    <span class="text-danger">{{ $errors->first('wlists') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.wlists_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="for_roles">{{ trans('cruds.appointment.fields.for_role') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('for_roles') ? 'is-invalid' : '' }}" name="for_roles[]" id="for_roles" multiple>
                    @foreach($for_roles as $id => $for_role)
                        <option value="{{ $id }}" {{ in_array($id, old('for_roles', [])) ? 'selected' : '' }}>{{ $for_role }}</option>
                    @endforeach
                </select>
                @if($errors->has('for_roles'))
                    <span class="text-danger">{{ $errors->first('for_roles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.for_role_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="for_users">{{ trans('cruds.appointment.fields.for_user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('for_users') ? 'is-invalid' : '' }}" name="for_users[]" id="for_users" multiple>
                    @foreach($for_users as $id => $for_user)
                        <option value="{{ $id }}" {{ in_array($id, old('for_users', [])) ? 'selected' : '' }}>{{ $for_user }}</option>
                    @endforeach
                </select>
                @if($errors->has('for_users'))
                    <span class="text-danger">{{ $errors->first('for_users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.for_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="when_starts">{{ trans('cruds.appointment.fields.when_starts') }}</label>
                <input class="form-control datetime {{ $errors->has('when_starts') ? 'is-invalid' : '' }}" type="text" name="when_starts" id="when_starts" value="{{ old('when_starts') }}" required>
                @if($errors->has('when_starts'))
                    <span class="text-danger">{{ $errors->first('when_starts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.when_starts_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="when_ends">{{ trans('cruds.appointment.fields.when_ends') }}</label>
                <input class="form-control datetime {{ $errors->has('when_ends') ? 'is-invalid' : '' }}" type="text" name="when_ends" id="when_ends" value="{{ old('when_ends') }}" required>
                @if($errors->has('when_ends'))
                    <span class="text-danger">{{ $errors->first('when_ends') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.when_ends_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.appointment.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}" required>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="priority_id">{{ trans('cruds.appointment.fields.priority') }}</label>
                <select class="form-control select2 {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority_id" id="priority_id">
                    @foreach($priorities as $id => $entry)
                        <option value="{{ $id }}" {{ old('priority_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('priority'))
                    <span class="text-danger">{{ $errors->first('priority') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.priority_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coordinates">{{ trans('cruds.appointment.fields.coordinates') }}</label>
                <input class="form-control {{ $errors->has('coordinates') ? 'is-invalid' : '' }}" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', '') }}">
                @if($errors->has('coordinates'))
                    <span class="text-danger">{{ $errors->first('coordinates') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.coordinates_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.appointment.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection