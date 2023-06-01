<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Http\Resources\Admin\ProviderResource;
use App\Models\Provider;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProviderApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('provider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProviderResource(Provider::with(['company', 'brands'])->get());
    }

    public function store(StoreProviderRequest $request)
    {
        $provider = Provider::create($request->all());
        $provider->brands()->sync($request->input('brands', []));
        if ($request->input('provider_logo', false)) {
            $provider->addMedia(storage_path('tmp/uploads/' . basename($request->input('provider_logo'))))->toMediaCollection('provider_logo');
        }

        foreach ($request->input('price_lists', []) as $file) {
            $provider->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('price_lists');
        }

        return (new ProviderResource($provider))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Provider $provider)
    {
        abort_if(Gate::denies('provider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProviderResource($provider->load(['company', 'brands']));
    }

    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());
        $provider->brands()->sync($request->input('brands', []));
        if ($request->input('provider_logo', false)) {
            if (! $provider->provider_logo || $request->input('provider_logo') !== $provider->provider_logo->file_name) {
                if ($provider->provider_logo) {
                    $provider->provider_logo->delete();
                }
                $provider->addMedia(storage_path('tmp/uploads/' . basename($request->input('provider_logo'))))->toMediaCollection('provider_logo');
            }
        } elseif ($provider->provider_logo) {
            $provider->provider_logo->delete();
        }

        if (count($provider->price_lists) > 0) {
            foreach ($provider->price_lists as $media) {
                if (! in_array($media->file_name, $request->input('price_lists', []))) {
                    $media->delete();
                }
            }
        }
        $media = $provider->price_lists->pluck('file_name')->toArray();
        foreach ($request->input('price_lists', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $provider->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('price_lists');
            }
        }

        return (new ProviderResource($provider))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Provider $provider)
    {
        abort_if(Gate::denies('provider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provider->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
