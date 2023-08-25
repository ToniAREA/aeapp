<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProformaRequest;
use App\Http\Requests\UpdateProformaRequest;
use App\Http\Resources\Admin\ProformaResource;
use App\Models\Proforma;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProformaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('proforma_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProformaResource(Proforma::with(['client', 'boats', 'wlists'])->get());
    }

    public function store(StoreProformaRequest $request)
    {
        $proforma = Proforma::create($request->all());
        $proforma->boats()->sync($request->input('boats', []));
        $proforma->wlists()->sync($request->input('wlists', []));

        return (new ProformaResource($proforma))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProformaResource($proforma->load(['client', 'boats', 'wlists']));
    }

    public function update(UpdateProformaRequest $request, Proforma $proforma)
    {
        $proforma->update($request->all());
        $proforma->boats()->sync($request->input('boats', []));
        $proforma->wlists()->sync($request->input('wlists', []));

        return (new ProformaResource($proforma))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proforma->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
