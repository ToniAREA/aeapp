<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\Admin\BrandResource;
use App\Models\Brand;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BrandsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('brand_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BrandResource(Brand::with(['providers'])->get());
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create($request->all());
        $brand->providers()->sync($request->input('providers', []));
        if ($request->input('brand_logo', false)) {
            $brand->addMedia(storage_path('tmp/uploads/' . basename($request->input('brand_logo'))))->toMediaCollection('brand_logo');
        }

        return (new BrandResource($brand))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Brand $brand)
    {
        abort_if(Gate::denies('brand_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BrandResource($brand->load(['providers']));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());
        $brand->providers()->sync($request->input('providers', []));
        if ($request->input('brand_logo', false)) {
            if (! $brand->brand_logo || $request->input('brand_logo') !== $brand->brand_logo->file_name) {
                if ($brand->brand_logo) {
                    $brand->brand_logo->delete();
                }
                $brand->addMedia(storage_path('tmp/uploads/' . basename($request->input('brand_logo'))))->toMediaCollection('brand_logo');
            }
        } elseif ($brand->brand_logo) {
            $brand->brand_logo->delete();
        }

        return (new BrandResource($brand))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Brand $brand)
    {
        abort_if(Gate::denies('brand_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
