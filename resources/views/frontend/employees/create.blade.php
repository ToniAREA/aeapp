@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.employee.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.employees.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="id_employee">{{ trans('cruds.employee.fields.id_employee') }}</label>
                            <input class="form-control" type="text" name="id_employee" id="id_employee" value="{{ old('id_employee', '') }}">
                            @if($errors->has('id_employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.id_employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.employee.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_id">{{ trans('cruds.employee.fields.contact') }}</label>
                            <select class="form-control select2" name="contact_id" id="contact_id">
                                @foreach($contacts as $id => $entry)
                                    <option value="{{ $id }}" {{ old('contact_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('contact'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.contact_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photo">{{ trans('cruds.employee.fields.photo') }}</label>
                            <div class="needsclick dropzone" id="photo-dropzone">
                            </div>
                            @if($errors->has('photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.photo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.employee.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contract_starts">{{ trans('cruds.employee.fields.contract_starts') }}</label>
                            <input class="form-control date" type="text" name="contract_starts" id="contract_starts" value="{{ old('contract_starts') }}">
                            @if($errors->has('contract_starts'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contract_starts') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.contract_starts_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contract_ends">{{ trans('cruds.employee.fields.contract_ends') }}</label>
                            <input class="form-control date" type="text" name="contract_ends" id="contract_ends" value="{{ old('contract_ends') }}">
                            @if($errors->has('contract_ends'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contract_ends') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.contract_ends_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.employee.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internalnotes">{{ trans('cruds.employee.fields.internalnotes') }}</label>
                            <input class="form-control" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', '') }}">
                            @if($errors->has('internalnotes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internalnotes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.internalnotes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.employee.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', '') }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.link_helper') }}</span>
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
    Dropzone.options.photoDropzone = {
    url: '{{ route('frontend.employees.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($employee) && $employee->photo)
      var file = {!! json_encode($employee->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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