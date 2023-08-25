@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.matLog.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.mat-logs.update", [$matLog->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="boat_id">{{ trans('cruds.matLog.fields.boat') }}</label>
                            <select class="form-control select2" name="boat_id" id="boat_id" required>
                                @foreach($boats as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('boat_id') ? old('boat_id') : $matLog->boat->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('boat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.boat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boat_namecomplete">{{ trans('cruds.matLog.fields.boat_namecomplete') }}</label>
                            <input class="form-control" type="text" name="boat_namecomplete" id="boat_namecomplete" value="{{ old('boat_namecomplete', $matLog->boat_namecomplete) }}">
                            @if($errors->has('boat_namecomplete'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat_namecomplete') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.boat_namecomplete_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="wlist_id">{{ trans('cruds.matLog.fields.wlist') }}</label>
                            <select class="form-control select2" name="wlist_id" id="wlist_id">
                                @foreach($wlists as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('wlist_id') ? old('wlist_id') : $matLog->wlist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('wlist'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wlist') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.wlist_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.matLog.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $matLog->date) }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="employee_id">{{ trans('cruds.matLog.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id" required>
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $matLog->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="item">{{ trans('cruds.matLog.fields.item') }}</label>
                            <input class="form-control" type="text" name="item" id="item" value="{{ old('item', $matLog->item) }}">
                            @if($errors->has('item'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('item') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.item_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_id">{{ trans('cruds.matLog.fields.product') }}</label>
                            <select class="form-control select2" name="product_id" id="product_id">
                                @foreach($products as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $matLog->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.product_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.matLog.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $matLog->description) }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pvp">{{ trans('cruds.matLog.fields.pvp') }}</label>
                            <input class="form-control" type="number" name="pvp" id="pvp" value="{{ old('pvp', $matLog->pvp) }}" step="0.01">
                            @if($errors->has('pvp'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pvp') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.pvp_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="units">{{ trans('cruds.matLog.fields.units') }}</label>
                            <input class="form-control" type="number" name="units" id="units" value="{{ old('units', $matLog->units) }}" step="0.01">
                            @if($errors->has('units'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('units') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.units_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="proforma_number_id">{{ trans('cruds.matLog.fields.proforma_number') }}</label>
                            <select class="form-control select2" name="proforma_number_id" id="proforma_number_id">
                                @foreach($proforma_numbers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('proforma_number_id') ? old('proforma_number_id') : $matLog->proforma_number->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('proforma_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('proforma_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.proforma_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="invoiced_line" value="0">
                                <input type="checkbox" name="invoiced_line" id="invoiced_line" value="1" {{ $matLog->invoiced_line || old('invoiced_line', 0) === 1 ? 'checked' : '' }}>
                                <label for="invoiced_line">{{ trans('cruds.matLog.fields.invoiced_line') }}</label>
                            </div>
                            @if($errors->has('invoiced_line'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoiced_line') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.invoiced_line_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.matLog.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', $matLog->status) }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.matLog.fields.status_helper') }}</span>
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