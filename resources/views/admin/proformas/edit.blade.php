@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.proforma.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.proformas.update", [$proforma->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="proforma_number">{{ trans('cruds.proforma.fields.proforma_number') }}</label>
                <input class="form-control {{ $errors->has('proforma_number') ? 'is-invalid' : '' }}" type="text" name="proforma_number" id="proforma_number" value="{{ old('proforma_number', $proforma->proforma_number) }}" required>
                @if($errors->has('proforma_number'))
                    <span class="text-danger">{{ $errors->first('proforma_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.proforma_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.proforma.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $proforma->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boats">{{ trans('cruds.proforma.fields.boats') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('boats') ? 'is-invalid' : '' }}" name="boats[]" id="boats" multiple>
                    @foreach($boats as $id => $boat)
                        <option value="{{ $id }}" {{ (in_array($id, old('boats', [])) || $proforma->boats->contains($id)) ? 'selected' : '' }}>{{ $boat }}</option>
                    @endforeach
                </select>
                @if($errors->has('boats'))
                    <span class="text-danger">{{ $errors->first('boats') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.boats_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wlists">{{ trans('cruds.proforma.fields.wlists') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('wlists') ? 'is-invalid' : '' }}" name="wlists[]" id="wlists" multiple>
                    @foreach($wlists as $id => $wlist)
                        <option value="{{ $id }}" {{ (in_array($id, old('wlists', [])) || $proforma->wlists->contains($id)) ? 'selected' : '' }}>{{ $wlist }}</option>
                    @endforeach
                </select>
                @if($errors->has('wlists'))
                    <span class="text-danger">{{ $errors->first('wlists') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.wlists_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.proforma.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $proforma->date) }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.proforma.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $proforma->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_amount">{{ trans('cruds.proforma.fields.total_amount') }}</label>
                <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $proforma->total_amount) }}" step="0.01">
                @if($errors->has('total_amount'))
                    <span class="text-danger">{{ $errors->first('total_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.total_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="currency">{{ trans('cruds.proforma.fields.currency') }}</label>
                <input class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" type="text" name="currency" id="currency" value="{{ old('currency', $proforma->currency) }}">
                @if($errors->has('currency'))
                    <span class="text-danger">{{ $errors->first('currency') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('sent') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="sent" value="0">
                    <input class="form-check-input" type="checkbox" name="sent" id="sent" value="1" {{ $proforma->sent || old('sent', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="sent">{{ trans('cruds.proforma.fields.sent') }}</label>
                </div>
                @if($errors->has('sent'))
                    <span class="text-danger">{{ $errors->first('sent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.sent_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('paid') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="paid" value="0">
                    <input class="form-check-input" type="checkbox" name="paid" id="paid" value="1" {{ $proforma->paid || old('paid', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="paid">{{ trans('cruds.proforma.fields.paid') }}</label>
                </div>
                @if($errors->has('paid'))
                    <span class="text-danger">{{ $errors->first('paid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="claims">{{ trans('cruds.proforma.fields.claims') }}</label>
                <input class="form-control {{ $errors->has('claims') ? 'is-invalid' : '' }}" type="number" name="claims" id="claims" value="{{ old('claims', $proforma->claims) }}" step="1">
                @if($errors->has('claims'))
                    <span class="text-danger">{{ $errors->first('claims') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.claims_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.proforma.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $proforma->link) }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.proforma.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $proforma->status) }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proforma.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.proforma.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $proforma->notes) }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
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



@endsection