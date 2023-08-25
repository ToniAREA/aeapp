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
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProformaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('proforma_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Proforma::with(['client', 'boats', 'wlists'])->select(sprintf('%s.*', (new Proforma)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'proforma_show';
                $editGate      = 'proforma_edit';
                $deleteGate    = 'proforma_delete';
                $crudRoutePart = 'proformas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('proforma_number', function ($row) {
                return $row->proforma_number ? $row->proforma_number : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('client.lastname', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->lastname) : '';
            });
            $table->editColumn('boats', function ($row) {
                $labels = [];
                foreach ($row->boats as $boat) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $boat->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('wlists', function ($row) {
                $labels = [];
                foreach ($row->wlists as $wlist) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $wlist->description);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('total_amount', function ($row) {
                return $row->total_amount ? $row->total_amount : '';
            });
            $table->editColumn('currency', function ($row) {
                return $row->currency ? $row->currency : '';
            });
            $table->editColumn('sent', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->sent ? 'checked' : null) . '>';
            });
            $table->editColumn('paid', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->paid ? 'checked' : null) . '>';
            });
            $table->editColumn('claims', function ($row) {
                return $row->claims ? $row->claims : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'boats', 'wlists', 'sent', 'paid']);

            return $table->make(true);
        }

        return view('admin.proformas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('proforma_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $wlists = Wlist::pluck('description', 'id');

        return view('admin.proformas.create', compact('boats', 'clients', 'wlists'));
    }

    public function store(StoreProformaRequest $request)
    {
        $proforma = Proforma::create($request->all());
        $proforma->boats()->sync($request->input('boats', []));
        $proforma->wlists()->sync($request->input('wlists', []));

        return redirect()->route('admin.proformas.index');
    }

    public function edit(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $wlists = Wlist::pluck('description', 'id');

        $proforma->load('client', 'boats', 'wlists');

        return view('admin.proformas.edit', compact('boats', 'clients', 'proforma', 'wlists'));
    }

    public function update(UpdateProformaRequest $request, Proforma $proforma)
    {
        $proforma->update($request->all());
        $proforma->boats()->sync($request->input('boats', []));
        $proforma->wlists()->sync($request->input('wlists', []));

        return redirect()->route('admin.proformas.index');
    }

    public function show(Proforma $proforma)
    {
        abort_if(Gate::denies('proforma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proforma->load('client', 'boats', 'wlists', 'proformaNumberWlogs', 'proformaNumberClaims', 'proformaNumberPayments', 'proformaNumberMatLogs');

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
