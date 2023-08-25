@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.boat.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.boats.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $boat->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.ref') }}
                                    </th>
                                    <td>
                                        {{ $boat->ref }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.boat_type') }}
                                    </th>
                                    <td>
                                        {{ $boat->boat_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $boat->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.imo') }}
                                    </th>
                                    <td>
                                        {{ $boat->imo }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.mmsi') }}
                                    </th>
                                    <td>
                                        {{ $boat->mmsi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.marina') }}
                                    </th>
                                    <td>
                                        {{ $boat->marina->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $boat->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.internalnotes') }}
                                    </th>
                                    <td>
                                        {{ $boat->internalnotes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.clients') }}
                                    </th>
                                    <td>
                                        @foreach($boat->clients as $key => $clients)
                                            <span class="label label-info">{{ $clients->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.coordinates') }}
                                    </th>
                                    <td>
                                        {{ $boat->coordinates }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $boat->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.last_use') }}
                                    </th>
                                    <td>
                                        {{ $boat->last_use }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.boats.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection