@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.priority.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.priorities.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="level">{{ trans('cruds.priority.fields.level') }}</label>
                            <input class="form-control" type="text" name="level" id="level" value="{{ old('level', '') }}">
                            @if($errors->has('level'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('level') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.priority.fields.level_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="weight">{{ trans('cruds.priority.fields.weight') }}</label>
                            <input class="form-control" type="number" name="weight" id="weight" value="{{ old('weight', '') }}" step="1">
                            @if($errors->has('weight'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('weight') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.priority.fields.weight_helper') }}</span>
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