<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClaimRequest;
use App\Http\Requests\StoreClaimRequest;
use App\Http\Requests\UpdateClaimRequest;
use App\Models\Claim;
use App\Models\Proforma;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClaimController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('claim_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claims = Claim::with(['proforma_number'])->get();

        return view('frontend.claims.index', compact('claims'));
    }

    public function create()
    {
        abort_if(Gate::denies('claim_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proforma_numbers = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.claims.create', compact('proforma_numbers'));
    }

    public function store(StoreClaimRequest $request)
    {
        $claim = Claim::create($request->all());

        return redirect()->route('frontend.claims.index');
    }

    public function edit(Claim $claim)
    {
        abort_if(Gate::denies('claim_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proforma_numbers = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim->load('proforma_number');

        return view('frontend.claims.edit', compact('claim', 'proforma_numbers'));
    }

    public function update(UpdateClaimRequest $request, Claim $claim)
    {
        $claim->update($request->all());

        return redirect()->route('frontend.claims.index');
    }

    public function show(Claim $claim)
    {
        abort_if(Gate::denies('claim_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claim->load('proforma_number');

        return view('frontend.claims.show', compact('claim'));
    }

    public function destroy(Claim $claim)
    {
        abort_if(Gate::denies('claim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claim->delete();

        return back();
    }

    public function massDestroy(MassDestroyClaimRequest $request)
    {
        $claims = Claim::find(request('ids'));

        foreach ($claims as $claim) {
            $claim->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
