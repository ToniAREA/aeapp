@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.marina.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.marinas.update", [$marina->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.marina.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $marina->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="coordinates">{{ trans('cruds.marina.fields.coordinates') }}</label>
                            <input class="form-control" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', $marina->coordinates) }}">
                            @if($errors->has('coordinates'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('coordinates') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.coordinates_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="lastuse">{{ trans('cruds.marina.fields.lastuse') }}</label>
                            <input class="form-control date" type="text" name="lastuse" id="lastuse" value="{{ old('lastuse', $marina->lastuse) }}">
                            @if($errors->has('lastuse'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lastuse') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.lastuse_helper') }}</span>
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