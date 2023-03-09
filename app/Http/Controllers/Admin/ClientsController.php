<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Boat;
use App\Models\Client;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Client::with(['boats'])->select(sprintf('%s.*', (new Client)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_show';
                $editGate      = 'client_edit';
                $deleteGate    = 'client_delete';
                $crudRoutePart = 'clients';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('lastname', function ($row) {
                return $row->lastname ? $row->lastname : '';
            });
            $table->editColumn('boats', function ($row) {
                $labels = [];
                foreach ($row->boats as $boat) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $boat->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('vat', function ($row) {
                return $row->vat ? $row->vat : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internalnotes', function ($row) {
                return $row->internalnotes ? $row->internalnotes : '';
            });
            $table->editColumn('defaulter', function ($row) {
                return $row->defaulter ? Client::DEFAULTER_RADIO[$row->defaulter] : '';
            });

            $table->editColumn('link_fd', function ($row) {
                return $row->link_fd ? $row->link_fd : '';
            });
            $table->editColumn('coordinates', function ($row) {
                return $row->coordinates ? $row->coordinates : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'boats']);

            return $table->make(true);
        }

        $boats = Boat::get();

        return view('admin.clients.index', compact('boats'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id');

        return view('admin.clients.create', compact('boats'));
    }

    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->all());
        $client->boats()->sync($request->input('boats', []));

        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id');

        $client->load('boats');

        return view('admin.clients.edit', compact('boats', 'client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());
        $client->boats()->sync($request->input('boats', []));

        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->load('boats', 'clientWlists', 'clientBoats');

        return view('admin.clients.show', compact('client'));
    }

    public function destroy(Client $client)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        $clients = Client::find(request('ids'));

        foreach ($clients as $client) {
            $client->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
