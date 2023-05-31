@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.brand.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.brands.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.brands.index') }}">
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