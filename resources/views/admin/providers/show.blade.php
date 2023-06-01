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
                            {{ trans('cruds.provider.fields.brands') }}
                        </th>
                        <td>
                            @foreach($provider->brands as $key => $brands)
                                <span class="label label-info">{{ $brands->brand }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.price_lists') }}
                        </th>
                        <td>
                            @foreach($provider->price_lists as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provider.fields.notes') }}
                        </th>
                        <td>
                            {{ $provider->notes }}
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
            <a class="nav-link" href="#providers_brands" role="tab" data-toggle="tab">
                {{ trans('cruds.brand.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="providers_brands">
            @includeIf('admin.providers.relationships.providersBrands', ['brands' => $provider->providersBrands])
        </div>
    </div>
</div>

@endsection