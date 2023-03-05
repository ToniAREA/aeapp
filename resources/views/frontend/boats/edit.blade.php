@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.boat.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.boats.update", [$boat->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.boat.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $boat->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="clients">{{ trans('cruds.boat.fields.client') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="clients[]" id="clients" multiple required>
                                @foreach($clients as $id => $client)
                                    <option value="{{ $id }}" {{ (in_array($id, old('clients', [])) || $boat->clients->contains($id)) ? 'selected' : '' }}>{{ $client }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('clients'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clients') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.boat.fields.client_helper') }}</span>
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