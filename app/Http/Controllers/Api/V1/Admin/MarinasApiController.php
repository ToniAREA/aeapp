<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMarinaRequest;
use App\Http\Requests\UpdateMarinaRequest;
use App\Http\Resources\Admin\MarinaResource;
use App\Models\Marina;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarinasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('marina_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MarinaResource(Marina::all());
    }

    public function store(StoreMarinaRequest $request)
    {
        $marina = Marina::create($request->all());

        return (new MarinaResource($marina))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Marina $marina)
    {
        abort_if(Gate::denies('marina_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MarinaResource($marina);
    }

    public function update(UpdateMarinaRequest $request, Marina $marina)
    {
        $marina->update($request->all());

        return (new MarinaResource($marina))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Marina $marina)
    {
        abort_if(Gate::denies('marina_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marina->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
