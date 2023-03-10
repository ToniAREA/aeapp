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
                <label class="required" for="id_marina">{{ trans('cruds.marina.fields.id_marina') }}</label>
                <input class="form-control {{ $errors->has('id_marina') ? 'is-invalid' : '' }}" type="text" name="id_marina" id="id_marina" value="{{ old('id_marina', $marina->id_marina) }}" required>
                @if($errors->has('id_marina'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_marina') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.id_marina_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.marina.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $marina->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coordinates">{{ trans('cruds.marina.fields.coordinates') }}</label>
                <input class="form-control {{ $errors->has('coordinates') ? 'is-invalid' : '' }}" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', $marina->coordinates) }}">
                @if($errors->has('coordinates'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coordinates') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.coordinates_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lastuse">{{ trans('cruds.marina.fields.lastuse') }}</label>
                <input class="form-control date {{ $errors->has('lastuse') ? 'is-invalid' : '' }}" type="text" name="lastuse" id="lastuse" value="{{ old('lastuse', $marina->lastuse) }}">
                @if($errors->has('lastuse'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lastuse') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.lastuse_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boats">{{ trans('cruds.marina.fields.boats') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('boats') ? 'is-invalid' : '' }}" name="boats[]" id="boats" multiple>
                    @foreach($boats as $id => $boat)
                        <option value="{{ $id }}" {{ (in_array($id, old('boats', [])) || $marina->boats->contains($id)) ? 'selected' : '' }}>{{ $boat }}</option>
                    @endforeach
                </select>
                @if($errors->has('boats'))
                    <div class="invalid-feedback">
                        {{ $errors->first('boats') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.boats_helper') }}</span>
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