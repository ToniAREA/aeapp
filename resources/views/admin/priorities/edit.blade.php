@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.priority.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.priorities.update", [$priority->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="level">{{ trans('cruds.priority.fields.level') }}</label>
                <input class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }}" type="text" name="level" id="level" value="{{ old('level', $priority->level) }}">
                @if($errors->has('level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.priority.fields.level_helper') }}</span>
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