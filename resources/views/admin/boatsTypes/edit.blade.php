@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.boatsType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.boats-types.update", [$boatsType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="boats_types">{{ trans('cruds.boatsType.fields.boats_type') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('boats_types') ? 'is-invalid' : '' }}" name="boats_types[]" id="boats_types" multiple>
                    @foreach($boats_types as $id => $boats_type)
                        <option value="{{ $id }}" {{ (in_array($id, old('boats_types', [])) || $boatsType->boats_types->contains($id)) ? 'selected' : '' }}>{{ $boats_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('boats_types'))
                    <div class="invalid-feedback">
                        {{ $errors->first('boats_types') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.boatsType.fields.boats_type_helper') }}</span>
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