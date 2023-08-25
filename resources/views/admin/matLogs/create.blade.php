@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.matLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mat-logs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="boat_id">{{ trans('cruds.matLog.fields.boat') }}</label>
                <select class="form-control select2 {{ $errors->has('boat') ? 'is-invalid' : '' }}" name="boat_id" id="boat_id" required>
                    @foreach($boats as $id => $entry)
                        <option value="{{ $id }}" {{ old('boat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('boat'))
                    <span class="text-danger">{{ $errors->first('boat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.boat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boat_namecomplete">{{ trans('cruds.matLog.fields.boat_namecomplete') }}</label>
                <input class="form-control {{ $errors->has('boat_namecomplete') ? 'is-invalid' : '' }}" type="text" name="boat_namecomplete" id="boat_namecomplete" value="{{ old('boat_namecomplete', '') }}">
                @if($errors->has('boat_namecomplete'))
                    <span class="text-danger">{{ $errors->first('boat_namecomplete') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.boat_namecomplete_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wlist_id">{{ trans('cruds.matLog.fields.wlist') }}</label>
                <select class="form-control select2 {{ $errors->has('wlist') ? 'is-invalid' : '' }}" name="wlist_id" id="wlist_id">
                    @foreach($wlists as $id => $entry)
                        <option value="{{ $id }}" {{ old('wlist_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('wlist'))
                    <span class="text-danger">{{ $errors->first('wlist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.wlist_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.matLog.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.matLog.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="item">{{ trans('cruds.matLog.fields.item') }}</label>
                <input class="form-control {{ $errors->has('item') ? 'is-invalid' : '' }}" type="text" name="item" id="item" value="{{ old('item', '') }}">
                @if($errors->has('item'))
                    <span class="text-danger">{{ $errors->first('item') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.item_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.matLog.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.matLog.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp">{{ trans('cruds.matLog.fields.pvp') }}</label>
                <input class="form-control {{ $errors->has('pvp') ? 'is-invalid' : '' }}" type="number" name="pvp" id="pvp" value="{{ old('pvp', '') }}" step="0.01">
                @if($errors->has('pvp'))
                    <span class="text-danger">{{ $errors->first('pvp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.pvp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="units">{{ trans('cruds.matLog.fields.units') }}</label>
                <input class="form-control {{ $errors->has('units') ? 'is-invalid' : '' }}" type="number" name="units" id="units" value="{{ old('units', '') }}" step="0.01">
                @if($errors->has('units'))
                    <span class="text-danger">{{ $errors->first('units') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.units_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proforma_number_id">{{ trans('cruds.matLog.fields.proforma_number') }}</label>
                <select class="form-control select2 {{ $errors->has('proforma_number') ? 'is-invalid' : '' }}" name="proforma_number_id" id="proforma_number_id">
                    @foreach($proforma_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ old('proforma_number_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('proforma_number'))
                    <span class="text-danger">{{ $errors->first('proforma_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.proforma_number_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('invoiced_line') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="invoiced_line" value="0">
                    <input class="form-check-input" type="checkbox" name="invoiced_line" id="invoiced_line" value="1" {{ old('invoiced_line', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="invoiced_line">{{ trans('cruds.matLog.fields.invoiced_line') }}</label>
                </div>
                @if($errors->has('invoiced_line'))
                    <span class="text-danger">{{ $errors->first('invoiced_line') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.matLog.fields.invoiced_line_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.matLog.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
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



@endsection