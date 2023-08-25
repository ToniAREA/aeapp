@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.payment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.payments.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="payment_gateway">{{ trans('cruds.payment.fields.payment_gateway') }}</label>
                            <input class="form-control" type="text" name="payment_gateway" id="payment_gateway" value="{{ old('payment_gateway', '') }}">
                            @if($errors->has('payment_gateway'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_gateway') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.payment_gateway_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="id_transaction">{{ trans('cruds.payment.fields.id_transaction') }}</label>
                            <input class="form-control" type="text" name="id_transaction" id="id_transaction" value="{{ old('id_transaction', '') }}">
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
                                    <option value="{{ $id }}" {{ old('proforma_number_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', '') }}" step="0.01">
                            @if($errors->has('total_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.total_amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="currency">{{ trans('cruds.payment.fields.currency') }}</label>
                            <input class="form-control" type="text" name="currency" id="currency" value="{{ old('currency', 'EUR') }}">
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.payment.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.status_helper') }}</span>
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