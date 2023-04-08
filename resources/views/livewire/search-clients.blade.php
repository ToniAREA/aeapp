<div>
    <input type="text" class="form-control" placeholder="Search client..." wire:model="searchTerm" />
    <ul class="list-group mt-3">
        @foreach ($resoults as $client)
            <li class="list-group-item">{{ $client->name }}</li>
        @endforeach
    </ul>
</div>
