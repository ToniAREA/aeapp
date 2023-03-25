@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.brand.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.brands.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="brand">{{ trans('cruds.brand.fields.brand') }}</label>
                            <input class="form-control" type="text" name="brand" id="brand" value="{{ old('brand', '') }}" required>
                            @if($errors->has('brand'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('brand') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.brand.fields.brand_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="providers">{{ trans('cruds.brand.fields.provider') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="providers[]" id="providers" multiple>
                                @foreach($providers as $id => $provider)
                                    <option value="{{ $id }}" {{ in_array($id, old('providers', [])) ? 'selected' : '' }}>{{ $provider }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('providers'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('providers') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.brand.fields.provider_helper') }}</span>
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