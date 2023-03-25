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
                <input class="form-control {{ $errors->has('id_mlog') ? 'is-invalid' : '' }}" type="text" name="id_mlog" id="id_mlog" value="{{ old('id_mlog', $mlog->id_mlog) }}">
                @if($errors->has('id_mlog'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_mlog') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.id_mlog_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.mlog.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $mlog->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="wlist_id">{{ trans('cruds.mlog.fields.wlist') }}</label>
                <select class="form-control select2 {{ $errors->has('wlist') ? 'is-invalid' : '' }}" name="wlist_id" id="wlist_id" required>
                    @foreach($wlists as $id => $entry)
                        <option value="{{ $id }}" {{ (old('wlist_id') ? old('wlist_id') : $mlog->wlist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('wlist'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wlist') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mlog.fields.wlist_helper') }}</span>
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