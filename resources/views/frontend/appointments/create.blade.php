@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.appointments.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="client_id">{{ trans('cruds.appointment.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id">
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boat_id">{{ trans('cruds.appointment.fields.boat') }}</label>
                            <select class="form-control select2" name="boat_id" id="boat_id">
                                @foreach($boats as $id => $entry)
                                    <option value="{{ $id }}" {{ old('boat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('boat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.boat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="wlists">{{ trans('cruds.appointment.fields.wlists') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="wlists[]" id="wlists" multiple>
                                @foreach($wlists as $id => $wlist)
                                    <option value="{{ $id }}" {{ in_array($id, old('wlists', [])) ? 'selected' : '' }}>{{ $wlist }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('wlists'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wlists') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.wlists_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="for_roles">{{ trans('cruds.appointment.fields.for_role') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="for_roles[]" id="for_roles" multiple>
                                @foreach($for_roles as $id => $for_role)
                                    <option value="{{ $id }}" {{ in_array($id, old('for_roles', [])) ? 'selected' : '' }}>{{ $for_role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.for_role_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="for_users">{{ trans('cruds.appointment.fields.for_user') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="for_users[]" id="for_users" multiple>
                                @foreach($for_users as $id => $for_user)
                                    <option value="{{ $id }}" {{ in_array($id, old('for_users', [])) ? 'selected' : '' }}>{{ $for_user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_users'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_users') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.for_user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boat_namecomplete">{{ trans('cruds.appointment.fields.boat_namecomplete') }}</label>
                            <input class="form-control" type="text" name="boat_namecomplete" id="boat_namecomplete" value="{{ old('boat_namecomplete', '') }}">
                            @if($errors->has('boat_namecomplete'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat_namecomplete') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.boat_namecomplete_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="description">{{ trans('cruds.appointment.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}" required>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="when_starts">{{ trans('cruds.appointment.fields.when_starts') }}</label>
                            <input class="form-control datetime" type="text" name="when_starts" id="when_starts" value="{{ old('when_starts') }}" required>
                            @if($errors->has('when_starts'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('when_starts') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.when_starts_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="when_ends">{{ trans('cruds.appointment.fields.when_ends') }}</label>
                            <input class="form-control datetime" type="text" name="when_ends" id="when_ends" value="{{ old('when_ends') }}" required>
                            @if($errors->has('when_ends'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('when_ends') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.when_ends_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="priority_id">{{ trans('cruds.appointment.fields.priority') }}</label>
                            <select class="form-control select2" name="priority_id" id="priority_id">
                                @foreach($priorities as $id => $entry)
                                    <option value="{{ $id }}" {{ old('priority_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('priority'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('priority') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.priority_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.appointment.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.appointment.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="coordinates">{{ trans('cruds.appointment.fields.coordinates') }}</label>
                            <input class="form-control" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', '') }}">
                            @if($errors->has('coordinates'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('coordinates') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.coordinates_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection