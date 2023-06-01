<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBrandRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Provider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BrandsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('brand_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::with(['providers', 'media'])->get();

        return view('frontend.brands.index', compact('brands'));
    }

    public function create()
    {
        abort_if(Gate::denies('brand_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $providers = Provider::pluck('name', 'id');

        return view('frontend.brands.create', compact('providers'));
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create($request->all());
        $brand->providers()->sync($request->input('providers', []));
        if ($request->input('brand_logo', false)) {
            $brand->addMedia(storage_path('tmp/uploads/' . basename($request->input('brand_logo'))))->toMediaCollection('brand_logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $brand->id]);
        }

        return redirect()->route('frontend.brands.index');
    }

    public function edit(Brand $brand)
    {
        abort_if(Gate::denies('brand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $providers = Provider::pluck('name', 'id');

        $brand->load('providers');

        return view('frontend.brands.edit', compact('brand', 'providers'));
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

        return redirect()->route('frontend.brands.index');
    }

    public function show(Brand $brand)
    {
        abort_if(Gate::denies('brand_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand->load('providers', 'brandProducts', 'brandsProviders');

        return view('frontend.brands.show', compact('brand'));
    }

    public function destroy(Brand $brand)
    {
        abort_if(Gate::denies('brand_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand->delete();

        return back();
    }

    public function massDestroy(MassDestroyBrandRequest $request)
    {
        $brands = Brand::find(request('ids'));

        foreach ($brands as $brand) {
            $brand->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('brand_create') && Gate::denies('brand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Brand();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
