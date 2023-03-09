@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.clients.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.client.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="lastname">{{ trans('cruds.client.fields.lastname') }}</label>
                            <input class="form-control" type="text" name="lastname" id="lastname" value="{{ old('lastname', '') }}">
                            @if($errors->has('lastname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lastname') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.lastname_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boats">{{ trans('cruds.client.fields.boats') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="boats[]" id="boats" multiple>
                                @foreach($boats as $id => $boat)
                                    <option value="{{ $id }}" {{ in_array($id, old('boats', [])) ? 'selected' : '' }}>{{ $boat }}</option>
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
                            <label for="vat">{{ trans('cruds.client.fields.vat') }}</label>
                            <input class="form-control" type="text" name="vat" id="vat" value="{{ old('vat', '') }}">
                            @if($errors->has('vat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.vat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.client.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', '') }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="country">{{ trans('cruds.client.fields.country') }}</label>
                            <input class="form-control" type="text" name="country" id="country" value="{{ old('country', '') }}">
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.client.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('cruds.client.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mobile">{{ trans('cruds.client.fields.mobile') }}</label>
                            <input class="form-control" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                            @if($errors->has('mobile'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.mobile_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.client.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internalnotes">{{ trans('cruds.client.fields.internalnotes') }}</label>
                            <input class="form-control" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', '') }}">
                            @if($errors->has('internalnotes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internalnotes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.internalnotes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.client.fields.defaulter') }}</label>
                            @foreach(App\Models\Client::DEFAULTER_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="defaulter_{{ $key }}" name="defaulter" value="{{ $key }}" {{ old('defaulter', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="defaulter_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('defaulter'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('defaulter') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.defaulter_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="lastuse">{{ trans('cruds.client.fields.lastuse') }}</label>
                            <input class="form-control date" type="text" name="lastuse" id="lastuse" value="{{ old('lastuse') }}">
                            @if($errors->has('lastuse'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lastuse') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.lastuse_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_fd">{{ trans('cruds.client.fields.link_fd') }}</label>
                            <input class="form-control" type="text" name="link_fd" id="link_fd" value="{{ old('link_fd', '') }}">
                            @if($errors->has('link_fd'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_fd') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.link_fd_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="coordinates">{{ trans('cruds.client.fields.coordinates') }}</label>
                            <input class="form-control" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', '') }}">
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