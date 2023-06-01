@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.client.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.clients.update", [$client->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="defaulter" value="0">
                                <input type="checkbox" name="defaulter" id="defaulter" value="1" {{ $client->defaulter || old('defaulter', 0) === 1 ? 'checked' : '' }}>
                                <label for="defaulter">{{ trans('cruds.client.fields.defaulter') }}</label>
                            </div>
                            @if($errors->has('defaulter'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('defaulter') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.defaulter_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="id_client">{{ trans('cruds.client.fields.id_client') }}</label>
                            <input class="form-control" type="number" name="id_client" id="id_client" value="{{ old('id_client', $client->id_client) }}" step="1" required>
                            @if($errors->has('id_client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.id_client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_id">{{ trans('cruds.client.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id">
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $client->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contacts">{{ trans('cruds.client.fields.contacts') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="contacts[]" id="contacts" multiple>
                                @foreach($contacts as $id => $contact)
                                    <option value="{{ $id }}" {{ (in_array($id, old('contacts', [])) || $client->contacts->contains($id)) ? 'selected' : '' }}>{{ $contact }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('contacts'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contacts') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.contacts_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boats">{{ trans('cruds.client.fields.boats') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="boats[]" id="boats" multiple>
                                @foreach($boats as $id => $boat)
                                    <option value="{{ $id }}" {{ (in_array($id, old('boats', [])) || $client->boats->contains($id)) ? 'selected' : '' }}>{{ $boat }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('boats'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boats') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.boats_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.client.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', $client->notes) }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internalnotes">{{ trans('cruds.client.fields.internalnotes') }}</label>
                            <input class="form-control" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', $client->internalnotes) }}">
                            @if($errors->has('internalnotes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internalnotes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.internalnotes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.client.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', $client->link) }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="coordinates">{{ trans('cruds.client.fields.coordinates') }}</label>
                            <input class="form-control" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', $client->coordinates) }}">
                            @if($errors->has('coordinates'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('coordinates') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.coordinates_helper') }}</span>
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