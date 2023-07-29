@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.boat.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.boats.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="id_boat">{{ trans('cruds.boat.fields.id_boat') }}</label>
                <input class="form-control {{ $errors->has('id_boat') ? 'is-invalid' : '' }}" type="number" name="id_boat" id="id_boat" value="{{ old('id_boat', '') }}" step="1" required>
                @if($errors->has('id_boat'))
                    <span class="text-danger">{{ $errors->first('id_boat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.id_boat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boat_type_id">{{ trans('cruds.boat.fields.boat_type') }}</label>
                <select class="form-control select2 {{ $errors->has('boat_type') ? 'is-invalid' : '' }}" name="boat_type_id" id="boat_type_id">
                    @foreach($boat_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('boat_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('boat_type'))
                    <span class="text-danger">{{ $errors->first('boat_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.boat_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.boat.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="imo">{{ trans('cruds.boat.fields.imo') }}</label>
                <input class="form-control {{ $errors->has('imo') ? 'is-invalid' : '' }}" type="text" name="imo" id="imo" value="{{ old('imo', '') }}">
                @if($errors->has('imo'))
                    <span class="text-danger">{{ $errors->first('imo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.imo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mmsi">{{ trans('cruds.boat.fields.mmsi') }}</label>
                <input class="form-control {{ $errors->has('mmsi') ? 'is-invalid' : '' }}" type="text" name="mmsi" id="mmsi" value="{{ old('mmsi', '') }}">
                @if($errors->has('mmsi'))
                    <span class="text-danger">{{ $errors->first('mmsi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.mmsi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="marina_id">{{ trans('cruds.boat.fields.marina') }}</label>
                <select class="form-control select2 {{ $errors->has('marina') ? 'is-invalid' : '' }}" name="marina_id" id="marina_id">
                    @foreach($marinas as $id => $entry)
                        <option value="{{ $id }}" {{ old('marina_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('marina'))
                    <span class="text-danger">{{ $errors->first('marina') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.marina_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="clients">{{ trans('cruds.boat.fields.client') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('clients') ? 'is-invalid' : '' }}" name="clients[]" id="clients" multiple>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ in_array($id, old('clients', [])) ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('clients'))
                    <span class="text-danger">{{ $errors->first('clients') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.boat.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internalnotes">{{ trans('cruds.boat.fields.internalnotes') }}</label>
                <input class="form-control {{ $errors->has('internalnotes') ? 'is-invalid' : '' }}" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', '') }}">
                @if($errors->has('internalnotes'))
                    <span class="text-danger">{{ $errors->first('internalnotes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.internalnotes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coordinates">{{ trans('cruds.boat.fields.coordinates') }}</label>
                <input class="form-control {{ $errors->has('coordinates') ? 'is-invalid' : '' }}" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', '') }}">
                @if($errors->has('coordinates'))
                    <span class="text-danger">{{ $errors->first('coordinates') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.coordinates_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.boat.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.link_helper') }}</span>
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