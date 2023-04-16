@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.claim.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.claims.update", [$claim->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="proforma_number_id">{{ trans('cruds.claim.fields.proforma_number') }}</label>
                <select class="form-control select2 {{ $errors->has('proforma_number') ? 'is-invalid' : '' }}" name="proforma_number_id" id="proforma_number_id">
                    @foreach($proforma_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('proforma_number_id') ? old('proforma_number_id') : $claim->proforma_number->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('proforma_number'))
                    <span class="text-danger">{{ $errors->first('proforma_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.proforma_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.claim.fields.note') }}</label>
                <input class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" type="text" name="note" id="note" value="{{ old('note', $claim->note) }}">
                @if($errors->has('note'))
                    <span class="text-danger">{{ $errors->first('note') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="claim_date">{{ trans('cruds.claim.fields.claim_date') }}</label>
                <input class="form-control date {{ $errors->has('claim_date') ? 'is-invalid' : '' }}" type="text" name="claim_date" id="claim_date" value="{{ old('claim_date', $claim->claim_date) }}">
                @if($errors->has('claim_date'))
                    <span class="text-danger">{{ $errors->first('claim_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.claim_date_helper') }}</span>
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