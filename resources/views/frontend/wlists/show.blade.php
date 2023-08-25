@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.wlist.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.wlists.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $wlist->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.client') }}
                                    </th>
                                    <td>
                                        {{ $wlist->client->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.boat') }}
                                    </th>
                                    <td>
                                        {{ $wlist->boat->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.order_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Wlist::ORDER_TYPE_RADIO[$wlist->order_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.for_role') }}
                                    </th>
                                    <td>
                                        @foreach($wlist->for_roles as $key => $for_role)
                                            <span class="label label-info">{{ $for_role->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.for_user') }}
                                    </th>
                                    <td>
                                        @foreach($wlist->for_users as $key => $for_user)
                                            <span class="label label-info">{{ $for_user->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.boat_namecomplete') }}
                                    </th>
                                    <td>
                                        {{ $wlist->boat_namecomplete }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $wlist->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.photos') }}
                                    </th>
                                    <td>
                                        @foreach($wlist->photos as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.deadline') }}
                                    </th>
                                    <td>
                                        {{ $wlist->deadline }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.priority') }}
                                    </th>
                                    <td>
                                        {{ $wlist->priority->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $wlist->status }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.url_invoice') }}
                                    </th>
                                    <td>
                                        {{ $wlist->url_invoice }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlist.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $wlist->notes }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.wlists.index') }}">
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