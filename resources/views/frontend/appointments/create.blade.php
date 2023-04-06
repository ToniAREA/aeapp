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
                            <label class="required" for="client_id">{{ trans('cruds.appointment.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id" required>
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