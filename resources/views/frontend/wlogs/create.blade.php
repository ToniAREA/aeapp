@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.wlog.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.wlogs.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="wlist_id">{{ trans('cruds.wlog.fields.wlist') }}</label>
                            <select class="form-control select2" name="wlist_id" id="wlist_id">
                                @foreach($wlists as $id => $entry)
                                    <option value="{{ $id }}" {{ old('wlist_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('wlist'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wlist') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.wlist_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boat_namecomplete">{{ trans('cruds.wlog.fields.boat_namecomplete') }}</label>
                            <input class="form-control" type="text" name="boat_namecomplete" id="boat_namecomplete" value="{{ old('boat_namecomplete', '') }}">
                            @if($errors->has('boat_namecomplete'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat_namecomplete') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.boat_namecomplete_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.wlog.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date') }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="employee_id">{{ trans('cruds.wlog.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id" required>
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="marina_id">{{ trans('cruds.wlog.fields.marina') }}</label>
                            <select class="form-control select2" name="marina_id" id="marina_id">
                                @foreach($marinas as $id => $entry)
                                    <option value="{{ $id }}" {{ old('marina_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('marina'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('marina') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.marina_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.wlog.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hours">{{ trans('cruds.wlog.fields.hours') }}</label>
                            <input class="form-control" type="number" name="hours" id="hours" value="{{ old('hours', '') }}" step="0.01" max="24">
                            @if($errors->has('hours'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hours') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.hours_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="proforma_number_id">{{ trans('cruds.wlog.fields.proforma_number') }}</label>
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
                            <span class="help-block">{{ trans('cruds.wlog.fields.proforma_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="invoiced_line" value="0">
                                <input type="checkbox" name="invoiced_line" id="invoiced_line" value="1" {{ old('invoiced_line', 0) == 1 ? 'checked' : '' }}>
                                <label for="invoiced_line">{{ trans('cruds.wlog.fields.invoiced_line') }}</label>
                            </div>
                            @if($errors->has('invoiced_line'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoiced_line') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.invoiced_line_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.wlog.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection