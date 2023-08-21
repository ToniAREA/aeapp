<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoatRequest;
use App\Http\Requests\UpdateBoatRequest;
use App\Http\Resources\Admin\BoatResource;
use App\Models\Boat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoatsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('boat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BoatResource(Boat::with(['marina', 'clients'])->get());
    }

    public function store(StoreBoatRequest $request)
    {
        $boat = Boat::create($request->all());
        $boat->clients()->sync($request->input('clients', []));

        return (new BoatResource($boat))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Boat $boat)
    {
        abort_if(Gate::denies('boat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BoatResource($boat->load(['marina', 'clients']));
    }

    public function update(UpdateBoatRequest $request, Boat $boat)
    {
        $boat->update($request->all());
        $boat->clients()->sync($request->input('clients', []));

        return (new BoatResource($boat))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Boat $boat)
    {
        abort_if(Gate::denies('boat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boat->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
