<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProviderRequest;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Models\Brand;
use App\Models\ContactCompany;
use App\Models\Provider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProviderController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('provider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Provider::with(['brands', 'company'])->select(sprintf('%s.*', (new Provider)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'provider_show';
                $editGate      = 'provider_edit';
                $deleteGate    = 'provider_delete';
                $crudRoutePart = 'providers';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('brand', function ($row) {
                $labels = [];
                foreach ($row->brands as $brand) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $brand->brand);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('price_list', function ($row) {
                if (! $row->price_list) {
                    return '';
                }
                $links = [];
                foreach ($row->price_list as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->addColumn('company_company_name', function ($row) {
                return $row->company ? $row->company->company_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'brand', 'price_list', 'company']);

            return $table->make(true);
        }

        $brands            = Brand::get();
        $contact_companies = ContactCompany::get();

        return view('admin.providers.index', compact('brands', 'contact_companies'));
    }

    public function create()
    {
        abort_if(Gate::denies('provider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::pluck('brand', 'id');

        $companies = ContactCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.providers.create', compact('brands', 'companies'));
    }

    public function store(StoreProviderRequest $request)
    {
        $provider = Provider::create($request->all());
        $provider->brands()->sync($request->input('brands', []));
        foreach ($request->input('price_list', []) as $file) {
            $provider->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('price_list');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $provider->id]);
        }

        return redirect()->route('admin.providers.index');
    }

    public function edit(Provider $provider)
    {
        abort_if(Gate::denies('provider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::pluck('brand', 'id');

        $companies = ContactCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provider->load('brands', 'company');

        return view('admin.providers.edit', compact('brands', 'companies', 'provider'));
    }

    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());
        $provider->brands()->sync($request->input('brands', []));
        if (count($provider->price_list) > 0) {
            foreach ($provider->price_list as $media) {
                if (! in_array($media->file_name, $request->input('price_list', []))) {
                    $media->delete();
                }
            }
        }
        $media = $provider->price_list->pluck('file_name')->toArray();
        foreach ($request->input('price_list', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $provider->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('price_list');
            }
        }

        return redirect()->route('admin.providers.index');
    }

    public function show(Provider $provider)
    {
        abort_if(Gate::denies('provider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider->load('brands', 'company', 'providerBrands');

        return view('admin.providers.show', compact('provider'));
    }

    public function destroy(Provider $provider)
    {
        abort_if(Gate::denies('provider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider->delete();

        return back();
    }

    public function massDestroy(MassDestroyProviderRequest $request)
    {
        $providers = Provider::find(request('ids'));

        foreach ($providers as $provider) {
            $provider->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('provider_create') && Gate::denies('provider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Provider();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
