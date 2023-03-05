@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.toDo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.to-dos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="task">{{ trans('cruds.toDo.fields.task') }}</label>
                <input class="form-control {{ $errors->has('task') ? 'is-invalid' : '' }}" type="text" name="task" id="task" value="{{ old('task', '') }}">
                @if($errors->has('task'))
                    <div class="invalid-feedback">
                        {{ $errors->first('task') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.task_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.toDo.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deadline">{{ trans('cruds.toDo.fields.deadline') }}</label>
                <input class="form-control date {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline" value="{{ old('deadline') }}">
                @if($errors->has('deadline'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deadline') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.deadline_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="priority_id">{{ trans('cruds.toDo.fields.priority') }}</label>
                <select class="form-control select2 {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority_id" id="priority_id" required>
                    @foreach($priorities as $id => $entry)
                        <option value="{{ $id }}" {{ old('priority_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('priority'))
                    <div class="invalid-feedback">
                        {{ $errors->first('priority') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.priority_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('admin.to-dos.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($toDo) && $toDo->photo)
      var files = {!! json_encode($toDo->photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
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