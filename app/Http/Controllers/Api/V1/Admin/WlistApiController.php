<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreWlistRequest;
use App\Http\Requests\UpdateWlistRequest;
use App\Http\Resources\Admin\WlistResource;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WlistApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('wlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WlistResource(Wlist::with(['client', 'boat', 'for_roles', 'for_users', 'priority'])->get());
    }

    public function store(StoreWlistRequest $request)
    {
        $wlist = Wlist::create($request->all());
        $wlist->for_roles()->sync($request->input('for_roles', []));
        $wlist->for_users()->sync($request->input('for_users', []));
        foreach ($request->input('photos', []) as $file) {
            $wlist->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        return (new WlistResource($wlist))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WlistResource($wlist->load(['client', 'boat', 'for_roles', 'for_users', 'priority']));
    }

    public function update(UpdateWlistRequest $request, Wlist $wlist)
    {
        $wlist->update($request->all());
        $wlist->for_roles()->sync($request->input('for_roles', []));
        $wlist->for_users()->sync($request->input('for_users', []));
        if (count($wlist->photos) > 0) {
            foreach ($wlist->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $wlist->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $wlist->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return (new WlistResource($wlist))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlist->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
