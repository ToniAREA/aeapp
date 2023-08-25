<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Boat;
use App\Models\Client;
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

        $clients = Client::with(['contacts', 'boats'])->get();

        $contact_contacts = ContactContact::get();

        $boats = Boat::get();

        return view('frontend.clients.index', compact('boats', 'clients', 'contact_contacts'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        $boats = Boat::pluck('name', 'id');

        return view('frontend.clients.create', compact('boats', 'contacts'));
    }

    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->all());
        $client->contacts()->sync($request->input('contacts', []));
        $client->boats()->sync($request->input('boats', []));

        return redirect()->route('frontend.clients.index');
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        $boats = Boat::pluck('name', 'id');

        $client->load('contacts', 'boats');

        return view('frontend.clients.edit', compact('boats', 'client', 'contacts'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());
        $client->contacts()->sync($request->input('contacts', []));
        $client->boats()->sync($request->input('boats', []));

        return redirect()->route('frontend.clients.index');
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->load('contacts', 'boats', 'clientProformas', 'clientWlists', 'clientAppointments', 'clientsBoats');

        return view('frontend.clients.show', compact('client'));
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
