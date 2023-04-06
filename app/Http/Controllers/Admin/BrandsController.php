<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBrandRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Provider;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BrandsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('brand_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::with(['providers'])->get();

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        abort_if(Gate::denies('brand_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $providers = Provider::pluck('name', 'id');

        return view('admin.brands.create', compact('providers'));
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create($request->all());
        $brand->providers()->sync($request->input('providers', []));

        return redirect()->route('admin.brands.index');
    }

    public function edit(Brand $brand)
    {
        abort_if(Gate::denies('brand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $providers = Provider::pluck('name', 'id');

        $brand->load('providers');

        return view('admin.brands.edit', compact('brand', 'providers'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());
        $brand->providers()->sync($request->input('providers', []));

        return redirect()->route('admin.brands.index');
    }

    public function show(Brand $brand)
    {
        abort_if(Gate::denies('brand_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand->load('providers', 'brandProducts', 'brandProviders');

        return view('admin.brands.show', compact('brand'));
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
}
