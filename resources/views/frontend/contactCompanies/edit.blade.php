@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.contactCompany.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.contact-companies.update", [$contactCompany->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="defaulter" value="0">
                                <input type="checkbox" name="defaulter" id="defaulter" value="1" {{ $contactCompany->defaulter || old('defaulter', 0) === 1 ? 'checked' : '' }}>
                                <label for="defaulter">{{ trans('cruds.contactCompany.fields.defaulter') }}</label>
                            </div>
                            @if($errors->has('defaulter'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('defaulter') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactCompany.fields.defaulter_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_name">{{ trans('cruds.contactCompany.fields.company_name') }}</label>
                            <input class="form-control" type="text" name="company_name" id="company_name" value="{{ old('company_name', $contactCompany->company_name) }}">
                            @if($errors->has('company_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactCompany.fields.company_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_vat">{{ trans('cruds.contactCompany.fields.company_vat') }}</label>
                            <input class="form-control" type="text" name="company_vat" id="company_vat" value="{{ old('company_vat', $contactCompany->company_vat) }}">
                            @if($errors->has('company_vat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_vat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactCompany.fields.company_vat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_address">{{ trans('cruds.contactCompany.fields.company_address') }}</label>
                            <input class="form-control" type="text" name="company_address" id="company_address" value="{{ old('company_address', $contactCompany->company_address) }}">
                            @if($errors->has('company_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactCompany.fields.company_address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_mobile">{{ trans('cruds.contactCompany.fields.company_mobile') }}</label>
                            <input class="form-control" type="text" name="company_mobile" id="company_mobile" value="{{ old('company_mobile', $contactCompany->company_mobile) }}">
                            @if($errors->has('company_mobile'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_mobile') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactCompany.fields.company_mobile_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_phone">{{ trans('cruds.contactCompany.fields.company_phone') }}</label>
                            <input class="form-control" type="text" name="company_phone" id="company_phone" value="{{ old('company_phone', $contactCompany->company_phone) }}">
                            @if($errors->has('company_phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactCompany.fields.company_phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_email">{{ trans('cruds.contactCompany.fields.company_email') }}</label>
                            <input class="form-control" type="text" name="company_email" id="company_email" value="{{ old('company_email', $contactCompany->company_email) }}">
                            @if($errors->has('company_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactCompany.fields.company_email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_website">{{ trans('cruds.contactCompany.fields.company_website') }}</label>
                            <input class="form-control" type="text" name="company_website" id="company_website" value="{{ old('company_website', $contactCompany->company_website) }}">
                            @if($errors->has('company_website'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_website') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactCompany.fields.company_website_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_social_link">{{ trans('cruds.contactCompany.fields.company_social_link') }}</label>
                            <input class="form-control" type="text" name="company_social_link" id="company_social_link" value="{{ old('company_social_link', $contactCompany->company_social_link) }}">
                            @if($errors->has('company_social_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_social_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactCompany.fields.company_social_link_helper') }}</span>
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