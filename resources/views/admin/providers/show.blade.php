@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.provider.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.providers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.id') }}
                        </th>
                        <td>
                            {{ $provider->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.name') }}
                        </th>
                        <td>
                            {{ $provider->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.brand') }}
                        </th>
                        <td>
                            @foreach($provider->brands as $key => $brand)
                                <span class="label label-info">{{ $brand->brand }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.price_list') }}
                        </th>
                        <td>
                            @foreach($provider->price_list as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.company') }}
                        </th>
                        <td>
                            {{ $provider->company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.provider_logo') }}
                        </th>
                        <td>
                            @if($provider->provider_logo)
                                <a href="{{ $provider->provider_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $provider->provider_logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.internal_notes') }}
                        </th>
                        <td>
                            {{ $provider->internal_notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.providers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#provider_brands" role="tab" data-toggle="tab">
                {{ trans('cruds.brand.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="provider_brands">
            @includeIf('admin.providers.relationships.providerBrands', ['brands' => $provider->providerBrands])
        </div>
    </div>
</div>

@endsection