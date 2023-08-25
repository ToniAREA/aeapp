@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.contactContact.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.contact-contacts.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="contact_first_name">{{ trans('cruds.contactContact.fields.contact_first_name') }}</label>
                            <input class="form-control" type="text" name="contact_first_name" id="contact_first_name" value="{{ old('contact_first_name', '') }}">
                            @if($errors->has('contact_first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_first_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_last_name">{{ trans('cruds.contactContact.fields.contact_last_name') }}</label>
                            <input class="form-control" type="text" name="contact_last_name" id="contact_last_name" value="{{ old('contact_last_name', '') }}">
                            @if($errors->has('contact_last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_last_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_nif">{{ trans('cruds.contactContact.fields.contact_nif') }}</label>
                            <input class="form-control" type="text" name="contact_nif" id="contact_nif" value="{{ old('contact_nif', '') }}">
                            @if($errors->has('contact_nif'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_nif') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_nif_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_address">{{ trans('cruds.contactContact.fields.contact_address') }}</label>
                            <input class="form-control" type="text" name="contact_address" id="contact_address" value="{{ old('contact_address', '') }}">
                            @if($errors->has('contact_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_country">{{ trans('cruds.contactContact.fields.contact_country') }}</label>
                            <input class="form-control" type="text" name="contact_country" id="contact_country" value="{{ old('contact_country', '') }}">
                            @if($errors->has('contact_country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_mobile">{{ trans('cruds.contactContact.fields.contact_mobile') }}</label>
                            <input class="form-control" type="text" name="contact_mobile" id="contact_mobile" value="{{ old('contact_mobile', '') }}">
                            @if($errors->has('contact_mobile'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_mobile') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_mobile_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_mobile_2">{{ trans('cruds.contactContact.fields.contact_mobile_2') }}</label>
                            <input class="form-control" type="text" name="contact_mobile_2" id="contact_mobile_2" value="{{ old('contact_mobile_2', '') }}">
                            @if($errors->has('contact_mobile_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_mobile_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_mobile_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_email">{{ trans('cruds.contactContact.fields.contact_email') }}</label>
                            <input class="form-control" type="text" name="contact_email" id="contact_email" value="{{ old('contact_email', '') }}">
                            @if($errors->has('contact_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_email_2">{{ trans('cruds.contactContact.fields.contact_email_2') }}</label>
                            <input class="form-control" type="text" name="contact_email_2" id="contact_email_2" value="{{ old('contact_email_2', '') }}">
                            @if($errors->has('contact_email_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_email_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_email_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="social_link">{{ trans('cruds.contactContact.fields.social_link') }}</label>
                            <input class="form-control" type="text" name="social_link" id="social_link" value="{{ old('social_link', '') }}">
                            @if($errors->has('social_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('social_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.social_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_tags">{{ trans('cruds.contactContact.fields.contact_tags') }}</label>
                            <input class="form-control" type="text" name="contact_tags" id="contact_tags" value="{{ old('contact_tags', '') }}">
                            @if($errors->has('contact_tags'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_tags') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_tags_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_notes">{{ trans('cruds.contactContact.fields.contact_notes') }}</label>
                            <input class="form-control" type="text" name="contact_notes" id="contact_notes" value="{{ old('contact_notes', '') }}">
                            @if($errors->has('contact_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_internalnotes">{{ trans('cruds.contactContact.fields.contact_internalnotes') }}</label>
                            <input class="form-control" type="text" name="contact_internalnotes" id="contact_internalnotes" value="{{ old('contact_internalnotes', '') }}">
                            @if($errors->has('contact_internalnotes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_internalnotes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_internalnotes_helper') }}</span>
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