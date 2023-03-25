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
                <label class="required" for="date">{{ trans('cruds.wlog.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $wlog->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="wlist_id">{{ trans('cruds.wlog.fields.wlist') }}</label>
                <select class="form-control select2 {{ $errors->has('wlist') ? 'is-invalid' : '' }}" name="wlist_id" id="wlist_id" required>
                    @foreach($wlists as $id => $entry)
                        <option value="{{ $id }}" {{ (old('wlist_id') ? old('wlist_id') : $wlog->wlist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label class="required" for="employee_id">{{ trans('cruds.wlog.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $wlog->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <select class="form-control select2 {{ $errors->has('marina') ? 'is-invalid' : '' }}" name="marina_id" id="marina_id">
                    @foreach($marinas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('marina_id') ? old('marina_id') : $wlog->marina->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $wlog->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hours">{{ trans('cruds.wlog.fields.hours') }}</label>
                <input class="form-control {{ $errors->has('hours') ? 'is-invalid' : '' }}" type="number" name="hours" id="hours" value="{{ old('hours', $wlog->hours) }}" step="0.01" max="24">
                @if($errors->has('hours'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hours') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.wlog.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $wlog->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.tags_helper') }}</span>
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