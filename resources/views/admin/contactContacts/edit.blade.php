@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contactContact.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contact-contacts.update", [$contactContact->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="contact_first_name">{{ trans('cruds.contactContact.fields.contact_first_name') }}</label>
                <input class="form-control {{ $errors->has('contact_first_name') ? 'is-invalid' : '' }}" type="text" name="contact_first_name" id="contact_first_name" value="{{ old('contact_first_name', $contactContact->contact_first_name) }}">
                @if($errors->has('contact_first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.contact_first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_last_name">{{ trans('cruds.contactContact.fields.contact_last_name') }}</label>
                <input class="form-control {{ $errors->has('contact_last_name') ? 'is-invalid' : '' }}" type="text" name="contact_last_name" id="contact_last_name" value="{{ old('contact_last_name', $contactContact->contact_last_name) }}">
                @if($errors->has('contact_last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.contact_last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_email">{{ trans('cruds.contactContact.fields.contact_email') }}</label>
                <input class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" type="text" name="contact_email" id="contact_email" value="{{ old('contact_email', $contactContact->contact_email) }}">
                @if($errors->has('contact_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.contact_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_address">{{ trans('cruds.contactContact.fields.contact_address') }}</label>
                <input class="form-control {{ $errors->has('contact_address') ? 'is-invalid' : '' }}" type="text" name="contact_address" id="contact_address" value="{{ old('contact_address', $contactContact->contact_address) }}">
                @if($errors->has('contact_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.contact_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nif">{{ trans('cruds.contactContact.fields.nif') }}</label>
                <input class="form-control {{ $errors->has('nif') ? 'is-invalid' : '' }}" type="text" name="nif" id="nif" value="{{ old('nif', $contactContact->nif) }}">
                @if($errors->has('nif'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nif') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.nif_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.contactContact.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $contactContact->phone) }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile">{{ trans('cruds.contactContact.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $contactContact->mobile) }}">
                @if($errors->has('mobile'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.contactContact.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $contactContact->address) }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country">{{ trans('cruds.contactContact.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', $contactContact->country) }}">
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.contactContact.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $contactContact->notes) }}">
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internalnotes">{{ trans('cruds.contactContact.fields.internalnotes') }}</label>
                <input class="form-control {{ $errors->has('internalnotes') ? 'is-invalid' : '' }}" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', $contactContact->internalnotes) }}">
                @if($errors->has('internalnotes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('internalnotes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactContact.fields.internalnotes_helper') }}</span>
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