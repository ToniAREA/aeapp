@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.wlog.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.wlogs.update", [$wlog->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.wlog.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $wlog->date) }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="wlist_id">{{ trans('cruds.wlog.fields.wlist') }}</label>
                            <select class="form-control select2" name="wlist_id" id="wlist_id" required>
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