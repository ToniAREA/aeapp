@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.payment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.payments.update", [$payment->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="payment_gateway">{{ trans('cruds.payment.fields.payment_gateway') }}</label>
                            <input class="form-control" type="text" name="payment_gateway" id="payment_gateway" value="{{ old('payment_gateway', $payment->payment_gateway) }}">
                            @if($errors->has('payment_gateway'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_gateway') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.payment_gateway_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="id_transaction">{{ trans('cruds.payment.fields.id_transaction') }}</label>
                            <input class="form-control" type="text" name="id_transaction" id="id_transaction" value="{{ old('id_transaction', $payment->id_transaction) }}">
                            @if($errors->has('id_transaction'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_transaction') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.id_transaction_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="proforma_number_id">{{ trans('cruds.payment.fields.proforma_number') }}</label>
                            <select class="form-control select2" name="proforma_number_id" id="proforma_number_id">
                                @foreach($proforma_numbers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('proforma_number_id') ? old('proforma_number_id') : $payment->proforma_number->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('proforma_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('proforma_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.proforma_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_amount">{{ trans('cruds.payment.fields.total_amount') }}</label>
                            <input class="form-control" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $payment->total_amount) }}" step="0.01">
                            @if($errors->has('total_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.total_amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="currency">{{ trans('cruds.payment.fields.currency') }}</label>
                            <input class="form-control" type="text" name="currency" id="currency" value="{{ old('currency', $payment->currency) }}">
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.payment.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', $payment->status) }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tags">{{ trans('cruds.payment.fields.tags') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="tags[]" id="tags" multiple>
                                @foreach($tags as $id => $tag)
                                    <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $payment->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tags'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tags') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection