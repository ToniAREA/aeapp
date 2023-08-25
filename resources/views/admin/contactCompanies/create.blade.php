@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contactCompany.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contact-companies.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('defaulter') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="defaulter" value="0">
                    <input class="form-check-input" type="checkbox" name="defaulter" id="defaulter" value="1" {{ old('defaulter', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="defaulter">{{ trans('cruds.contactCompany.fields.defaulter') }}</label>
                </div>
                @if($errors->has('defaulter'))
                    <span class="text-danger">{{ $errors->first('defaulter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.defaulter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_name">{{ trans('cruds.contactCompany.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}">
                @if($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_vat">{{ trans('cruds.contactCompany.fields.company_vat') }}</label>
                <input class="form-control {{ $errors->has('company_vat') ? 'is-invalid' : '' }}" type="text" name="company_vat" id="company_vat" value="{{ old('company_vat', '') }}">
                @if($errors->has('company_vat'))
                    <span class="text-danger">{{ $errors->first('company_vat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_vat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_address">{{ trans('cruds.contactCompany.fields.company_address') }}</label>
                <input class="form-control {{ $errors->has('company_address') ? 'is-invalid' : '' }}" type="text" name="company_address" id="company_address" value="{{ old('company_address', '') }}">
                @if($errors->has('company_address'))
                    <span class="text-danger">{{ $errors->first('company_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_mobile">{{ trans('cruds.contactCompany.fields.company_mobile') }}</label>
                <input class="form-control {{ $errors->has('company_mobile') ? 'is-invalid' : '' }}" type="text" name="company_mobile" id="company_mobile" value="{{ old('company_mobile', '') }}">
                @if($errors->has('company_mobile'))
                    <span class="text-danger">{{ $errors->first('company_mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_phone">{{ trans('cruds.contactCompany.fields.company_phone') }}</label>
                <input class="form-control {{ $errors->has('company_phone') ? 'is-invalid' : '' }}" type="text" name="company_phone" id="company_phone" value="{{ old('company_phone', '') }}">
                @if($errors->has('company_phone'))
                    <span class="text-danger">{{ $errors->first('company_phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_email">{{ trans('cruds.contactCompany.fields.company_email') }}</label>
                <input class="form-control {{ $errors->has('company_email') ? 'is-invalid' : '' }}" type="text" name="company_email" id="company_email" value="{{ old('company_email', '') }}">
                @if($errors->has('company_email'))
                    <span class="text-danger">{{ $errors->first('company_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_website">{{ trans('cruds.contactCompany.fields.company_website') }}</label>
                <input class="form-control {{ $errors->has('company_website') ? 'is-invalid' : '' }}" type="text" name="company_website" id="company_website" value="{{ old('company_website', '') }}">
                @if($errors->has('company_website'))
                    <span class="text-danger">{{ $errors->first('company_website') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_website_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_social_link">{{ trans('cruds.contactCompany.fields.company_social_link') }}</label>
                <input class="form-control {{ $errors->has('company_social_link') ? 'is-invalid' : '' }}" type="text" name="company_social_link" id="company_social_link" value="{{ old('company_social_link', '') }}">
                @if($errors->has('company_social_link'))
                    <span class="text-danger">{{ $errors->first('company_social_link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_social_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contacts">{{ trans('cruds.contactCompany.fields.contacts') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('contacts') ? 'is-invalid' : '' }}" name="contacts[]" id="contacts" multiple>
                    @foreach($contacts as $id => $contact)
                        <option value="{{ $id }}" {{ in_array($id, old('contacts', [])) ? 'selected' : '' }}>{{ $contact }}</option>
                    @endforeach
                </select>
                @if($errors->has('contacts'))
                    <span class="text-danger">{{ $errors->first('contacts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.contacts_helper') }}</span>
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