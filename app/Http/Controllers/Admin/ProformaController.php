<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProformaRequest;
use App\Http\Requests\StoreProformaRequest;
use App\Http\Requests\UpdateProformaRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Proforma;
use App\Models\Tag;
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

        $proformas = Proforma::with(['client', 'boats', 'wlists', 'tags'])->get();

        return view('admin.proformas.index', compact('proformas'));
    }

    public function create()
    {
        abort_if(Gate::denies('proforma_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('id_client', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $wlists = Wlist::pluck('description', 'id');

        $tags = Tag::pluck('name', 'id');

        return view('admin.proformas.create', compact('boats', 'clients', 'tags', 'wlists'));
    }

    public function store(StoreProformaRequest $request)
    {
        $proforma = Proforma::create($request->all());
        $proforma->boats()->sync($request->input('boats', []));
        $proforma->wlists()->sync($request->input('wlists', []));
        $proforma->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.proformas.index');
    }

    public function edit(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('id_client', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $wlists = Wlist::pluck('description', 'id');

        $tags = Tag::pluck('name', 'id');

        $proforma->load('client', 'boats', 'wlists', 'tags');

        return view('admin.proformas.edit', compact('boats', 'clients', 'proforma', 'tags', 'wlists'));
    }

    public function update(UpdateProformaRequest $request, Proforma $proforma)
    {
        $proforma->update($request->all());
        $proforma->boats()->sync($request->input('boats', []));
        $proforma->wlists()->sync($request->input('wlists', []));
        $proforma->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.proformas.index');
    }

    public function show(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proforma->load('client', 'boats', 'wlists', 'tags', 'proformaNumberWlogs', 'proformaNumberMlogs', 'proformaNumberClaims', 'proformaNumberPayments');

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
