<div>
    <input type="text" class="form-control" placeholder="Search posts..." wire:model="search">
    <ul class="list-group mt-3">
        @foreach($resoult as $client)
            <li class="list-group-item">{{ $client->name }}</li>
        @endforeach
    </ul>
</div>