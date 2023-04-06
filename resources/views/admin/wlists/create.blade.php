@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.wlist.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.wlists.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.wlist.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="boat_id">{{ trans('cruds.wlist.fields.boat') }}</label>
                <select class="form-control select2 {{ $errors->has('boat') ? 'is-invalid' : '' }}" name="boat_id" id="boat_id" required>
                    @foreach($boats as $id => $entry)
                        <option value="{{ $id }}" {{ old('boat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('boat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('boat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.boat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="desciption">{{ trans('cruds.wlist.fields.desciption') }}</label>
                <input class="form-control {{ $errors->has('desciption') ? 'is-invalid' : '' }}" type="text" name="desciption" id="desciption" value="{{ old('desciption', '') }}" required>
                @if($errors->has('desciption'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desciption') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.desciption_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photos">{{ trans('cruds.wlist.fields.photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                </div>
                @if($errors->has('photos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.photos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deadline">{{ trans('cruds.wlist.fields.deadline') }}</label>
                <input class="form-control date {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline" value="{{ old('deadline') }}">
                @if($errors->has('deadline'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deadline') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.deadline_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="priority_id">{{ trans('cruds.wlist.fields.priority') }}</label>
                <select class="form-control select2 {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority_id" id="priority_id">
                    @foreach($priorities as $id => $entry)
                        <option value="{{ $id }}" {{ old('priority_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('priority'))
                    <div class="invalid-feedback">
                        {{ $errors->first('priority') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.priority_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="for_roles">{{ trans('cruds.wlist.fields.for_role') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('for_roles') ? 'is-invalid' : '' }}" name="for_roles[]" id="for_roles" multiple>
                    @foreach($for_roles as $id => $for_role)
                        <option value="{{ $id }}" {{ in_array($id, old('for_roles', [])) ? 'selected' : '' }}>{{ $for_role }}</option>
                    @endforeach
                </select>
                @if($errors->has('for_roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('for_roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.for_role_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="for_users">{{ trans('cruds.wlist.fields.for_user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('for_users') ? 'is-invalid' : '' }}" name="for_users[]" id="for_users" multiple>
                    @foreach($for_users as $id => $for_user)
                        <option value="{{ $id }}" {{ in_array($id, old('for_users', [])) ? 'selected' : '' }}>{{ $for_user }}</option>
                    @endforeach
                </select>
                @if($errors->has('for_users'))
                    <div class="invalid-feedback">
                        {{ $errors->first('for_users') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.for_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wlogs">{{ trans('cruds.wlist.fields.wlogs') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('wlogs') ? 'is-invalid' : '' }}" name="wlogs[]" id="wlogs" multiple>
                    @foreach($wlogs as $id => $wlog)
                        <option value="{{ $id }}" {{ in_array($id, old('wlogs', [])) ? 'selected' : '' }}>{{ $wlog }}</option>
                    @endforeach
                </select>
                @if($errors->has('wlogs'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wlogs') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wlist.fields.wlogs_helper') }}</span>
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
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '{{ route('admin.wlists.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotosMap[file.name]
      }
      $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($wlist) && $wlist->photos)
      var files = {!! json_encode($wlist->photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
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