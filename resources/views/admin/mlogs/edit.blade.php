@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.mlog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mlogs.update", [$mlog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="id_mlog">{{ trans('cruds.mlog.fields.id_mlog') }}</label>
                <input class="form-control {{ $errors->has('id_mlog') ? 'is-invalid' : '' }}" type="number" name="id_mlog" id="id_mlog" value="{{ old('id_mlog', $mlog->id_mlog) }}" step="1">
                @if($errors->has('id_mlog'))
                    <span class="text-danger">{{ $errors->first('id_mlog') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.id_mlog_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.mlog.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $mlog->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boat_id">{{ trans('cruds.mlog.fields.boat') }}</label>
                <select class="form-control select2 {{ $errors->has('boat') ? 'is-invalid' : '' }}" name="boat_id" id="boat_id">
                    @foreach($boats as $id => $entry)
                        <option value="{{ $id }}" {{ (old('boat_id') ? old('boat_id') : $mlog->boat->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('boat'))
                    <span class="text-danger">{{ $errors->first('boat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.boat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wlist_id">{{ trans('cruds.mlog.fields.wlist') }}</label>
                <select class="form-control select2 {{ $errors->has('wlist') ? 'is-invalid' : '' }}" name="wlist_id" id="wlist_id">
                    @foreach($wlists as $id => $entry)
                        <option value="{{ $id }}" {{ (old('wlist_id') ? old('wlist_id') : $mlog->wlist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('wlist'))
                    <span class="text-danger">{{ $errors->first('wlist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.wlist_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.mlog.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $mlog->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.mlog.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $mlog->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.mlog.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $mlog->quantity) }}" step="0.01">
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price_unit">{{ trans('cruds.mlog.fields.price_unit') }}</label>
                <input class="form-control {{ $errors->has('price_unit') ? 'is-invalid' : '' }}" type="number" name="price_unit" id="price_unit" value="{{ old('price_unit', $mlog->price_unit) }}" step="0.01">
                @if($errors->has('price_unit'))
                    <span class="text-danger">{{ $errors->first('price_unit') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.price_unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount">{{ trans('cruds.mlog.fields.discount') }}</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', $mlog->discount) }}" step="0.01">
                @if($errors->has('discount'))
                    <span class="text-danger">{{ $errors->first('discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total">{{ trans('cruds.mlog.fields.total') }}</label>
                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="number" name="total" id="total" value="{{ old('total', $mlog->total) }}" step="0.01">
                @if($errors->has('total'))
                    <span class="text-danger">{{ $errors->first('total') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.total_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.mlog.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $mlog->status) }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.mlog.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $mlog->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proforma_number_id">{{ trans('cruds.mlog.fields.proforma_number') }}</label>
                <select class="form-control select2 {{ $errors->has('proforma_number') ? 'is-invalid' : '' }}" name="proforma_number_id" id="proforma_number_id">
                    @foreach($proforma_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('proforma_number_id') ? old('proforma_number_id') : $mlog->proforma_number->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('proforma_number'))
                    <span class="text-danger">{{ $errors->first('proforma_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.proforma_number_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('invoiced_line') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="invoiced_line" value="0">
                    <input class="form-check-input" type="checkbox" name="invoiced_line" id="invoiced_line" value="1" {{ $mlog->invoiced_line || old('invoiced_line', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="invoiced_line">{{ trans('cruds.mlog.fields.invoiced_line') }}</label>
                </div>
                @if($errors->has('invoiced_line'))
                    <span class="text-danger">{{ $errors->first('invoiced_line') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.invoiced_line_helper') }}</span>
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