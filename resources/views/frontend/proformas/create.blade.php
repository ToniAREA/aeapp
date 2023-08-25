@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.proforma.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.proformas.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="proforma_number">{{ trans('cruds.proforma.fields.proforma_number') }}</label>
                            <input class="form-control" type="text" name="proforma_number" id="proforma_number" value="{{ old('proforma_number', '') }}" required>
                            @if($errors->has('proforma_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('proforma_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.proforma_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="client_id">{{ trans('cruds.proforma.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id">
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boats">{{ trans('cruds.proforma.fields.boats') }}</label>
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
                            <span class="help-block">{{ trans('cruds.proforma.fields.boats_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="wlists">{{ trans('cruds.proforma.fields.wlists') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="wlists[]" id="wlists" multiple>
                                @foreach($wlists as $id => $wlist)
                                    <option value="{{ $id }}" {{ in_array($id, old('wlists', [])) ? 'selected' : '' }}>{{ $wlist }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('wlists'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wlists') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.wlists_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date">{{ trans('cruds.proforma.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date') }}">
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.proforma.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_amount">{{ trans('cruds.proforma.fields.total_amount') }}</label>
                            <input class="form-control" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', '') }}" step="0.01">
                            @if($errors->has('total_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.total_amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="currency">{{ trans('cruds.proforma.fields.currency') }}</label>
                            <input class="form-control" type="text" name="currency" id="currency" value="{{ old('currency', 'EUR') }}">
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="sent" value="0">
                                <input type="checkbox" name="sent" id="sent" value="1" {{ old('sent', 0) == 1 ? 'checked' : '' }}>
                                <label for="sent">{{ trans('cruds.proforma.fields.sent') }}</label>
                            </div>
                            @if($errors->has('sent'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sent') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.sent_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="paid" value="0">
                                <input type="checkbox" name="paid" id="paid" value="1" {{ old('paid', 0) == 1 ? 'checked' : '' }}>
                                <label for="paid">{{ trans('cruds.proforma.fields.paid') }}</label>
                            </div>
                            @if($errors->has('paid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('paid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.paid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="claims">{{ trans('cruds.proforma.fields.claims') }}</label>
                            <input class="form-control" type="number" name="claims" id="claims" value="{{ old('claims', '0') }}" step="1">
                            @if($errors->has('claims'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('claims') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.claims_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.proforma.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', '') }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.proforma.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.proforma.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.notes_helper') }}</span>
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