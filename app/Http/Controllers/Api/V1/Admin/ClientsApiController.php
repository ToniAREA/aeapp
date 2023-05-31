<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\Admin\ClientResource;
use App\Models\Client;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientResource(Client::with(['company', 'contacts', 'boats'])->get());
    }

    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->all());
        $client->contacts()->sync($request->input('contacts', []));
        $client->boats()->sync($request->input('boats', []));

        return (new ClientResource($client))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientResource($client->load(['company', 'contacts', 'boats']));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());
        $client->contacts()->sync($request->input('contacts', []));
        $client->boats()->sync($request->input('boats', []));

        return (new ClientResource($client))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Client $client)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
