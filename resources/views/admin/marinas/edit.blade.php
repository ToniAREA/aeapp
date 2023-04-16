@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.marina.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.marinas.update", [$marina->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="id_marina">{{ trans('cruds.marina.fields.id_marina') }}</label>
                <input class="form-control {{ $errors->has('id_marina') ? 'is-invalid' : '' }}" type="number" name="id_marina" id="id_marina" value="{{ old('id_marina', $marina->id_marina) }}" step="1">
                @if($errors->has('id_marina'))
                    <span class="text-danger">{{ $errors->first('id_marina') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.id_marina_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.marina.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $marina->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coordinates">{{ trans('cruds.marina.fields.coordinates') }}</label>
                <input class="form-control {{ $errors->has('coordinates') ? 'is-invalid' : '' }}" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', $marina->coordinates) }}">
                @if($errors->has('coordinates'))
                    <span class="text-danger">{{ $errors->first('coordinates') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.coordinates_helper') }}</span>
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