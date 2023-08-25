<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProformaRequest;
use App\Http\Requests\StoreProformaRequest;
use App\Http\Requests\UpdateProformaRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Proforma;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProformaController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('proforma_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformas = Proforma::with(['client', 'boats', 'wlists'])->get();

        return view('frontend.proformas.index', compact('proformas'));
    }

    public function create()
    {
        abort_if(Gate::denies('proforma_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $wlists = Wlist::pluck('description', 'id');

        return view('frontend.proformas.create', compact('boats', 'clients', 'wlists'));
    }

    public function store(StoreProformaRequest $request)
    {
        $proforma = Proforma::create($request->all());
        $proforma->boats()->sync($request->input('boats', []));
        $proforma->wlists()->sync($request->input('wlists', []));

        return redirect()->route('frontend.proformas.index');
    }

    public function edit(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $wlists = Wlist::pluck('description', 'id');

        $proforma->load('client', 'boats', 'wlists');

        return view('frontend.proformas.edit', compact('boats', 'clients', 'proforma', 'wlists'));
    }

    public function update(UpdateProformaRequest $request, Proforma $proforma)
    {
        $proforma->update($request->all());
        $proforma->boats()->sync($request->input('boats', []));
        $proforma->wlists()->sync($request->input('wlists', []));

        return redirect()->route('frontend.proformas.index');
    }

    public function show(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proforma->load('client', 'boats', 'wlists', 'proformaNumberWlogs', 'proformaNumberClaims', 'proformaNumberPayments', 'proformaNumberMatLogs');

        return view('frontend.proformas.show', compact('proforma'));
    }

    public function destroy(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proforma->delete();

        return back();
    }

    public function massDestroy(MassDestroyProformaRequest $request)
    {
        $proformas = Proforma::find(request('ids'));

        foreach ($proformas as $proforma) {
            $proforma->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
