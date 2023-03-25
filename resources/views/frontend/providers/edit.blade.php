@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.provider.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.providers.update", [$provider->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.provider.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $provider->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.provider.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="brands">{{ trans('cruds.provider.fields.brand') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="brands[]" id="brands" multiple>
                                @foreach($brands as $id => $brand)
                                    <option value="{{ $id }}" {{ (in_array($id, old('brands', [])) || $provider->brands->contains($id)) ? 'selected' : '' }}>{{ $brand }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('brands'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('brands') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.provider.fields.brand_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="price_list">{{ trans('cruds.provider.fields.price_list') }}</label>
                            <div class="needsclick dropzone" id="price_list-dropzone">
                            </div>
                            @if($errors->has('price_list'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price_list') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.provider.fields.price_list_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_id">{{ trans('cruds.provider.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id">
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $provider->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.provider.fields.company_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedPriceListMap = {}
Dropzone.options.priceListDropzone = {
    url: '{{ route('frontend.providers.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="price_list[]" value="' + response.name + '">')
      uploadedPriceListMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPriceListMap[file.name]
      }
      $('form').find('input[name="price_list[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($provider) && $provider->price_list)
          var files =
            {!! json_encode($provider->price_list) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="price_list[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection