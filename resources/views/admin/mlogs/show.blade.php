@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mlog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mlogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.id') }}
                        </th>
                        <td>
                            {{ $mlog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.id_mlog') }}
                        </th>
                        <td>
                            {{ $mlog->id_mlog }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.date') }}
                        </th>
                        <td>
                            {{ $mlog->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mlog.fields.wlist') }}
                        </th>
                        <td>
                            {{ $mlog->wlist->desciption ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mlogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection