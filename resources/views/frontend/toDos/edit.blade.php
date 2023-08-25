@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.toDo.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.to-dos.update", [$toDo->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="task">{{ trans('cruds.toDo.fields.task') }}</label>
                            <input class="form-control" type="text" name="task" id="task" value="{{ old('task', $toDo->task) }}">
                            @if($errors->has('task'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('task') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.task_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photo">{{ trans('cruds.toDo.fields.photo') }}</label>
                            <div class="needsclick dropzone" id="photo-dropzone">
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
                            <input class="form-control date" type="text" name="deadline" id="deadline" value="{{ old('deadline', $toDo->deadline) }}">
                            @if($errors->has('deadline'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('deadline') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.deadline_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="priority">{{ trans('cruds.toDo.fields.priority') }}</label>
                            <input class="form-control" type="text" name="priority" id="priority" value="{{ old('priority', $toDo->priority) }}">
                            @if($errors->has('priority'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('priority') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.priority_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="for_roles">{{ trans('cruds.toDo.fields.for_role') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="for_roles[]" id="for_roles" multiple>
                                @foreach($for_roles as $id => $for_role)
                                    <option value="{{ $id }}" {{ (in_array($id, old('for_roles', [])) || $toDo->for_roles->contains($id)) ? 'selected' : '' }}>{{ $for_role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.for_role_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="for_users">{{ trans('cruds.toDo.fields.for_user') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="for_users[]" id="for_users" multiple>
                                @foreach($for_users as $id => $for_user)
                                    <option value="{{ $id }}" {{ (in_array($id, old('for_users', [])) || $toDo->for_users->contains($id)) ? 'selected' : '' }}>{{ $for_user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_users'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_users') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.for_user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.toDo.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', $toDo->notes) }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.notes_helper') }}</span>
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
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('frontend.to-dos.storeMedia') }}',
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