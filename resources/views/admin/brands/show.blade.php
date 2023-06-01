@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.brand.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.brands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.id') }}
                        </th>
                        <td>
                            {{ $brand->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.brand') }}
                        </th>
                        <td>
                            {{ $brand->brand }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.brand_logo') }}
                        </th>
                        <td>
                            @if($brand->brand_logo)
                                <a href="{{ $brand->brand_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $brand->brand_logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.brand_url') }}
                        </th>
                        <td>
                            {{ $brand->brand_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.providers') }}
                        </th>
                        <td>
                            @foreach($brand->providers as $key => $providers)
                                <span class="label label-info">{{ $providers->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.notes') }}
                        </th>
                        <td>
                            {{ $brand->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.internal_notes') }}
                        </th>
                        <td>
                            {{ $brand->internal_notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.brands.index') }}">
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
            <a class="nav-link" href="#brand_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#brands_providers" role="tab" data-toggle="tab">
                {{ trans('cruds.provider.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="brand_products">
            @includeIf('admin.brands.relationships.brandProducts', ['products' => $brand->brandProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="brands_providers">
            @includeIf('admin.brands.relationships.brandsProviders', ['providers' => $brand->brandsProviders])
        </div>
    </div>
</div>

@endsection