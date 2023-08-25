@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.wlog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.wlogs.update", [$wlog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="wlist_id">{{ trans('cruds.wlog.fields.wlist') }}</label>
                <select class="form-control select2 {{ $errors->has('wlist') ? 'is-invalid' : '' }}" name="wlist_id" id="wlist_id">
                    @foreach($wlists as $id => $entry)
                        <option value="{{ $id }}" {{ (old('wlist_id') ? old('wlist_id') : $wlog->wlist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('wlist'))
                    <span class="text-danger">{{ $errors->first('wlist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.wlist_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boat_namecomplete">{{ trans('cruds.wlog.fields.boat_namecomplete') }}</label>
                <input class="form-control {{ $errors->has('boat_namecomplete') ? 'is-invalid' : '' }}" type="text" name="boat_namecomplete" id="boat_namecomplete" value="{{ old('boat_namecomplete', $wlog->boat_namecomplete) }}">
                @if($errors->has('boat_namecomplete'))
                    <span class="text-danger">{{ $errors->first('boat_namecomplete') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.boat_namecomplete_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.wlog.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $wlog->date) }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.wlog.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $wlog->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="marina_id">{{ trans('cruds.wlog.fields.marina') }}</label>
                <select class="form-control select2 {{ $errors->has('marina') ? 'is-invalid' : '' }}" name="marina_id" id="marina_id">
                    @foreach($marinas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('marina_id') ? old('marina_id') : $wlog->marina->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('marina'))
                    <span class="text-danger">{{ $errors->first('marina') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.marina_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.wlog.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $wlog->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hours">{{ trans('cruds.wlog.fields.hours') }}</label>
                <input class="form-control {{ $errors->has('hours') ? 'is-invalid' : '' }}" type="number" name="hours" id="hours" value="{{ old('hours', $wlog->hours) }}" step="0.01" max="24">
                @if($errors->has('hours'))
                    <span class="text-danger">{{ $errors->first('hours') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proforma_number_id">{{ trans('cruds.wlog.fields.proforma_number') }}</label>
                <select class="form-control select2 {{ $errors->has('proforma_number') ? 'is-invalid' : '' }}" name="proforma_number_id" id="proforma_number_id">
                    @foreach($proforma_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('proforma_number_id') ? old('proforma_number_id') : $wlog->proforma_number->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('proforma_number'))
                    <span class="text-danger">{{ $errors->first('proforma_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.proforma_number_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('invoiced_line') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="invoiced_line" value="0">
                    <input class="form-check-input" type="checkbox" name="invoiced_line" id="invoiced_line" value="1" {{ $wlog->invoiced_line || old('invoiced_line', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="invoiced_line">{{ trans('cruds.wlog.fields.invoiced_line') }}</label>
                </div>
                @if($errors->has('invoiced_line'))
                    <span class="text-danger">{{ $errors->first('invoiced_line') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.invoiced_line_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.wlog.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $wlog->status) }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.status_helper') }}</span>
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