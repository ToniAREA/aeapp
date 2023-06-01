@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.payment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="payment_gateway">{{ trans('cruds.payment.fields.payment_gateway') }}</label>
                <input class="form-control {{ $errors->has('payment_gateway') ? 'is-invalid' : '' }}" type="text" name="payment_gateway" id="payment_gateway" value="{{ old('payment_gateway', '') }}">
                @if($errors->has('payment_gateway'))
                    <span class="text-danger">{{ $errors->first('payment_gateway') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.payment_gateway_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_transaction">{{ trans('cruds.payment.fields.id_transaction') }}</label>
                <input class="form-control {{ $errors->has('id_transaction') ? 'is-invalid' : '' }}" type="text" name="id_transaction" id="id_transaction" value="{{ old('id_transaction', '') }}">
                @if($errors->has('id_transaction'))
                    <span class="text-danger">{{ $errors->first('id_transaction') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.id_transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proforma_number_id">{{ trans('cruds.payment.fields.proforma_number') }}</label>
                <select class="form-control select2 {{ $errors->has('proforma_number') ? 'is-invalid' : '' }}" name="proforma_number_id" id="proforma_number_id">
                    @foreach($proforma_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ old('proforma_number_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('proforma_number'))
                    <span class="text-danger">{{ $errors->first('proforma_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.proforma_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_amount">{{ trans('cruds.payment.fields.total_amount') }}</label>
                <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', '') }}" step="0.01">
                @if($errors->has('total_amount'))
                    <span class="text-danger">{{ $errors->first('total_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.total_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="currency">{{ trans('cruds.payment.fields.currency') }}</label>
                <input class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" type="text" name="currency" id="currency" value="{{ old('currency', 'EUR') }}">
                @if($errors->has('currency'))
                    <span class="text-danger">{{ $errors->first('currency') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.payment.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.payment.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.tags_helper') }}</span>
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