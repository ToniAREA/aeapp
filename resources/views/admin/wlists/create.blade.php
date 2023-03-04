@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.wlist.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.wlists.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="desciption">{{ trans('cruds.wlist.fields.desciption') }}</label>
                <input class="form-control {{ $errors->has('desciption') ? 'is-invalid' : '' }}" type="text" name="desciption" id="desciption" value="{{ old('desciption', '') }}" required>
                @if($errors->has('desciption'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desciption') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.desciption_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wlogs">{{ trans('cruds.wlist.fields.wlogs') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('wlogs') ? 'is-invalid' : '' }}" name="wlogs[]" id="wlogs" multiple>
                    @foreach($wlogs as $id => $wlog)
                        <option value="{{ $id }}" {{ in_array($id, old('wlogs', [])) ? 'selected' : '' }}>{{ $wlog }}</option>
                    @endforeach
                </select>
                @if($errors->has('wlogs'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wlogs') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.wlogs_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.wlist.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="boat_id">{{ trans('cruds.wlist.fields.boat') }}</label>
                <select class="form-control select2 {{ $errors->has('boat') ? 'is-invalid' : '' }}" name="boat_id" id="boat_id" required>
                    @foreach($boats as $id => $entry)
                        <option value="{{ $id }}" {{ old('boat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('boat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('boat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.boat_helper') }}</span>
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