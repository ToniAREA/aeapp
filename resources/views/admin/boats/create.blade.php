@extends('layouts.admin')
@section('content')
    <div class="card">

        <div class="card-header border p-1 m-1">
            <b>{{ strtoupper(trans('global.create')) }} {{ strtoupper(trans('cruds.boat.title_singular')) }}</b>
            ID#{{ $lastRecordId + 1 }}
        </div>

        <div class="card-body p-1 m-1">
            <form method="POST" action="{{ route('admin.boats.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                    <input class="form-control {{ $errors->has('id_boat') ? 'is-invalid' : '' }}" type="number" name="id_boat"
                        id="id_boat" value="{{ old('id_boat', $lastRecordId + 1) }}" hidden>
                    @if ($errors->has('id_boat'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_boat') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.boat.fields.id_boat_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="type">{{ trans('cruds.boat.fields.type') }}</label>

                        <select name="type" id="type"
                            class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                            <option value="" disabled {{ old('type', '') === '' ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            <option value="TT" {{ old('type', '') === 'TT' ? 'selected' : '' }}>TT</option>
                            <option value="SY" {{ old('type', '') === 'SY' ? 'selected' : '' }}>SY</option>
                            <option value="MY" {{ old('type', '') === 'MY' ? 'selected' : '' }}>MY</option>
                            <option value="other" {{ old('type', '') === 'other' ? 'selected' : '' }}>Other</option>
                            <!-- Add more options as needed -->
                        </select>


                        @if ($errors->has('type'))
                            <div class="invalid-feedback">
                                {{ $errors->first('type') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.boat.fields.type_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.boat.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                        name="name" id="name" value="{{ old('name', '') }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.boat.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="marina_id">{{ trans('cruds.boat.fields.marina') }}</label>
                    <select class="form-control select2 {{ $errors->has('marina') ? 'is-invalid' : '' }}" name="marina_id"
                        id="marina_id">
                        @foreach ($marinas as $id => $entry)
                            <option value="{{ $id }}" {{ old('marina_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('marina'))
                        <div class="invalid-feedback">
                            {{ $errors->first('marina') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.boat.fields.marina_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="clients">{{ trans('cruds.boat.fields.client') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                            style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                            style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('clients') ? 'is-invalid' : '' }}" name="clients[]"
                        id="clients" multiple>
                        @foreach ($clients as $id => $client)
                            <option value="{{ $id }}" {{ in_array($id, old('clients', [])) ? 'selected' : '' }}>
                                {{ $client }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('clients'))
                        <div class="invalid-feedback">
                            {{ $errors->first('clients') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.boat.fields.client_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mmsi">{{ trans('cruds.boat.fields.mmsi') }}</label>
                    <input class="form-control {{ $errors->has('mmsi') ? 'is-invalid' : '' }}" type="text"
                        name="mmsi" id="mmsi" value="{{ old('mmsi', '') }}">
                    @if ($errors->has('mmsi'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mmsi') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.boat.fields.mmsi_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="notes">{{ trans('cruds.boat.fields.notes') }}</label>
                    <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text"
                        name="notes" id="notes" value="{{ old('notes', '') }}">
                    @if ($errors->has('notes'))
                        <div class="invalid-feedback">
                            {{ $errors->first('notes') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.boat.fields.notes_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="internalnotes">{{ trans('cruds.boat.fields.internalnotes') }}</label>
                    <input class="form-control {{ $errors->has('internalnotes') ? 'is-invalid' : '' }}" type="text"
                        name="internalnotes" id="internalnotes" value="{{ old('internalnotes', '') }}">
                    @if ($errors->has('internalnotes'))
                        <div class="invalid-feedback">
                            {{ $errors->first('internalnotes') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.boat.fields.internalnotes_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="lastuse">{{ trans('cruds.boat.fields.lastuse') }}</label>
                    <input class="form-control date {{ $errors->has('lastuse') ? 'is-invalid' : '' }}" type="text"
                        name="lastuse" id="lastuse" value="{{ old('lastuse') }}">
                    @if ($errors->has('lastuse'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lastuse') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.boat.fields.lastuse_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger btn-block" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
