<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWlistRequest;
use App\Http\Requests\UpdateWlistRequest;
use App\Http\Resources\Admin\WlistResource;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WlistApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('wlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WlistResource(Wlist::with(['client', 'boat', 'priority', 'wlogs'])->get());
    }

    public function store(StoreWlistRequest $request)
    {
        $wlist = Wlist::create($request->all());
        $wlist->wlogs()->sync($request->input('wlogs', []));

        return (new WlistResource($wlist))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WlistResource($wlist->load(['client', 'boat', 'priority', 'wlogs']));
    }

    public function update(UpdateWlistRequest $request, Wlist $wlist)
    {
        $wlist->update($request->all());
        $wlist->wlogs()->sync($request->input('wlogs', []));

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
