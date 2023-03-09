@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.marina.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.marinas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.id') }}
                        </th>
                        <td>
                            {{ $marina->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.name') }}
                        </th>
                        <td>
                            {{ $marina->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.coordinates') }}
                        </th>
                        <td>
                            {{ $marina->coordinates }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marina.fields.lastuse') }}
                        </th>
                        <td>
                            {{ $marina->lastuse }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.marinas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection