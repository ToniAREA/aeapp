@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clients.update", [$client->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('defaulter') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="defaulter" value="0">
                    <input class="form-check-input" type="checkbox" name="defaulter" id="defaulter" value="1" {{ $client->defaulter || old('defaulter', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="defaulter">{{ trans('cruds.client.fields.defaulter') }}</label>
                </div>
                @if($errors->has('defaulter'))
                    <span class="text-danger">{{ $errors->first('defaulter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.defaulter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ref">{{ trans('cruds.client.fields.ref') }}</label>
                <input class="form-control {{ $errors->has('ref') ? 'is-invalid' : '' }}" type="text" name="ref" id="ref" value="{{ old('ref', $client->ref) }}">
                @if($errors->has('ref'))
                    <span class="text-danger">{{ $errors->first('ref') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.ref_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.client.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $client->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lastname">{{ trans('cruds.client.fields.lastname') }}</label>
                <input class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" type="text" name="lastname" id="lastname" value="{{ old('lastname', $client->lastname) }}">
                @if($errors->has('lastname'))
                    <span class="text-danger">{{ $errors->first('lastname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.lastname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vat">{{ trans('cruds.client.fields.vat') }}</label>
                <input class="form-control {{ $errors->has('vat') ? 'is-invalid' : '' }}" type="text" name="vat" id="vat" value="{{ old('vat', $client->vat) }}">
                @if($errors->has('vat'))
                    <span class="text-danger">{{ $errors->first('vat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.vat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.client.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $client->address) }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country">{{ trans('cruds.client.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', $client->country) }}">
                @if($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="telephone">{{ trans('cruds.client.fields.telephone') }}</label>
                <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text" name="telephone" id="telephone" value="{{ old('telephone', $client->telephone) }}">
                @if($errors->has('telephone'))
                    <span class="text-danger">{{ $errors->first('telephone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.telephone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile">{{ trans('cruds.client.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $client->mobile) }}">
                @if($errors->has('mobile'))
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.client.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $client->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contacts">{{ trans('cruds.client.fields.contacts') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('contacts') ? 'is-invalid' : '' }}" name="contacts[]" id="contacts" multiple>
                    @foreach($contacts as $id => $contact)
                        <option value="{{ $id }}" {{ (in_array($id, old('contacts', [])) || $client->contacts->contains($id)) ? 'selected' : '' }}>{{ $contact }}</option>
                    @endforeach
                </select>
                @if($errors->has('contacts'))
                    <span class="text-danger">{{ $errors->first('contacts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.contacts_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boats">{{ trans('cruds.client.fields.boats') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('boats') ? 'is-invalid' : '' }}" name="boats[]" id="boats" multiple>
                    @foreach($boats as $id => $boat)
                        <option value="{{ $id }}" {{ (in_array($id, old('boats', [])) || $client->boats->contains($id)) ? 'selected' : '' }}>{{ $boat }}</option>
                    @endforeach
                </select>
                @if($errors->has('boats'))
                    <span class="text-danger">{{ $errors->first('boats') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.boats_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.client.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $client->notes) }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internalnotes">{{ trans('cruds.client.fields.internalnotes') }}</label>
                <input class="form-control {{ $errors->has('internalnotes') ? 'is-invalid' : '' }}" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', $client->internalnotes) }}">
                @if($errors->has('internalnotes'))
                    <span class="text-danger">{{ $errors->first('internalnotes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.internalnotes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.client.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $client->link) }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coordinates">{{ trans('cruds.client.fields.coordinates') }}</label>
                <input class="form-control {{ $errors->has('coordinates') ? 'is-invalid' : '' }}" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', $client->coordinates) }}">
                @if($errors->has('coordinates'))
                    <span class="text-danger">{{ $errors->first('coordinates') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.coordinates_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_use">{{ trans('cruds.client.fields.last_use') }}</label>
                <input class="form-control datetime {{ $errors->has('last_use') ? 'is-invalid' : '' }}" type="text" name="last_use" id="last_use" value="{{ old('last_use', $client->last_use) }}">
                @if($errors->has('last_use'))
                    <span class="text-danger">{{ $errors->first('last_use') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.last_use_helper') }}</span>
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