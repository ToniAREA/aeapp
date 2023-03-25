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
                                        {{ trans('cruds.boat.fields.id_boat') }}
                                    </th>
                                    <td>
                                        {{ $boat->id_boat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.type') }}
                                    </th>
                                    <td>
                                        {{ $boat->type }}
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
                                        {{ trans('cruds.boat.fields.marina') }}
                                    </th>
                                    <td>
                                        {{ $boat->marina->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.client') }}
                                    </th>
                                    <td>
                                        @foreach($boat->clients as $key => $client)
                                            <span class="label label-info">{{ $client->name }}</span>
                                        @endforeach
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
                                        {{ trans('cruds.boat.fields.lastuse') }}
                                    </th>
                                    <td>
                                        {{ $boat->lastuse }}
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