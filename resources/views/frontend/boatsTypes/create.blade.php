@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.boatsType.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.boats-types.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="boats_types">{{ trans('cruds.boatsType.fields.boats_type') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="boats_types[]" id="boats_types" multiple>
                                @foreach($boats_types as $id => $boats_type)
                                    <option value="{{ $id }}" {{ in_array($id, old('boats_types', [])) ? 'selected' : '' }}>{{ $boats_type }}</option>
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

        </div>
    </div>
</div>
@endsection