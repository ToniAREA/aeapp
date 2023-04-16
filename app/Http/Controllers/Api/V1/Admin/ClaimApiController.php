<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClaimRequest;
use App\Http\Requests\UpdateClaimRequest;
use App\Http\Resources\Admin\ClaimResource;
use App\Models\Claim;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClaimApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('claim_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClaimResource(Claim::with(['proforma_number'])->get());
    }

    public function store(StoreClaimRequest $request)
    {
        $claim = Claim::create($request->all());

        return (new ClaimResource($claim))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Claim $claim)
    {
        abort_if(Gate::denies('claim_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClaimResource($claim->load(['proforma_number']));
    }

    public function update(UpdateClaimRequest $request, Claim $claim)
    {
        $claim->update($request->all());

        return (new ClaimResource($claim))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Claim $claim)
    {
        abort_if(Gate::denies('claim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claim->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
