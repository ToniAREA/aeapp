<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\ContactCompany;
use App\Models\ContactContact;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::with(['company', 'contacts', 'boats'])->get();

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        $boats = Boat::pluck('name', 'id');

        return view('admin.clients.create', compact('boats', 'companies', 'contacts'));
    }

    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->all());
        $client->contacts()->sync($request->input('contacts', []));
        $client->boats()->sync($request->input('boats', []));

        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        $boats = Boat::pluck('name', 'id');

        $client->load('company', 'contacts', 'boats');

        return view('admin.clients.edit', compact('boats', 'client', 'companies', 'contacts'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());
        $client->contacts()->sync($request->input('contacts', []));
        $client->boats()->sync($request->input('boats', []));

        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->load('company', 'contacts', 'boats', 'clientWlists', 'clientAppointments', 'clientMlogs', 'clientProformas', 'clientBoats');

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
