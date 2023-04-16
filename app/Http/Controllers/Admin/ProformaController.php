<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProformaRequest;
use App\Http\Requests\StoreProformaRequest;
use App\Http\Requests\UpdateProformaRequest;
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

        $proformas = Proforma::with(['client', 'wlists'])->get();

        return view('admin.proformas.index', compact('proformas'));
    }

    public function create()
    {
        abort_if(Gate::denies('proforma_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('desciption', 'id');

        return view('admin.proformas.create', compact('clients', 'wlists'));
    }

    public function store(StoreProformaRequest $request)
    {
        $proforma = Proforma::create($request->all());
        $proforma->wlists()->sync($request->input('wlists', []));

        return redirect()->route('admin.proformas.index');
    }

    public function edit(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('desciption', 'id');

        $proforma->load('client', 'wlists');

        return view('admin.proformas.edit', compact('clients', 'proforma', 'wlists'));
    }

    public function update(UpdateProformaRequest $request, Proforma $proforma)
    {
        $proforma->update($request->all());
        $proforma->wlists()->sync($request->input('wlists', []));

        return redirect()->route('admin.proformas.index');
    }

    public function show(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proforma->load('client', 'wlists', 'proformaNumberWlogs', 'proformaNumberMlogs', 'proformaNumberClaims');

        return view('admin.proformas.show', compact('proforma'));
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
