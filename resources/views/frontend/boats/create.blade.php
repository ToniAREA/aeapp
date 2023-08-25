@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.boat.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.boats.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="ref">{{ trans('cruds.boat.fields.ref') }}</label>
                            <input class="form-control" type="text" name="ref" id="ref" value="{{ old('ref', '') }}">
                            @if($errors->has('ref'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ref') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.ref_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boat_type">{{ trans('cruds.boat.fields.boat_type') }}</label>
                            <input class="form-control" type="text" name="boat_type" id="boat_type" value="{{ old('boat_type', '') }}">
                            @if($errors->has('boat_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.boat_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.boat.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="imo">{{ trans('cruds.boat.fields.imo') }}</label>
                            <input class="form-control" type="text" name="imo" id="imo" value="{{ old('imo', '') }}">
                            @if($errors->has('imo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('imo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.imo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mmsi">{{ trans('cruds.boat.fields.mmsi') }}</label>
                            <input class="form-control" type="text" name="mmsi" id="mmsi" value="{{ old('mmsi', '') }}">
                            @if($errors->has('mmsi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mmsi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.mmsi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="marina_id">{{ trans('cruds.boat.fields.marina') }}</label>
                            <select class="form-control select2" name="marina_id" id="marina_id">
                                @foreach($marinas as $id => $entry)
                                    <option value="{{ $id }}" {{ old('marina_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('marina'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('marina') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.marina_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.boat.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internalnotes">{{ trans('cruds.boat.fields.internalnotes') }}</label>
                            <input class="form-control" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', '') }}">
                            @if($errors->has('internalnotes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internalnotes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.internalnotes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="clients">{{ trans('cruds.boat.fields.clients') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="clients[]" id="clients" multiple>
                                @foreach($clients as $id => $client)
                                    <option value="{{ $id }}" {{ in_array($id, old('clients', [])) ? 'selected' : '' }}>{{ $client }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('clients'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clients') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.clients_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="coordinates">{{ trans('cruds.boat.fields.coordinates') }}</label>
                            <input class="form-control" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', '') }}">
                            @if($errors->has('coordinates'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('coordinates') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.coordinates_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.boat.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', '') }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_use">{{ trans('cruds.boat.fields.last_use') }}</label>
                            <input class="form-control datetime" type="text" name="last_use" id="last_use" value="{{ old('last_use') }}">
                            @if($errors->has('last_use'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_use') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.last_use_helper') }}</span>
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