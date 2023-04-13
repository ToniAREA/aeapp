<input type="text" class="form-control" placeholder="Search client..." wire:model="searchTerm" />
<ul class="list-group mt-3">
    @foreach ($resoults as $client)
        <li class="list-group-item p-1">
            @can('client_show')
                <a class="text-muted" href="{{ route('admin.clients.show', $client->id) }}">
                @endcan
                {{ $client->id_client . '- ' . $client->name . ', ' . $client->lastname }}
                @can('client_show')
                </a>
            @endcan
            <span class="badge-icon" title="Number of boats related to this client.">{{$client->boats->count()}}<i class="fas fa-ship"></i>
            </span>
        </li>
    @endforeach
</ul>
