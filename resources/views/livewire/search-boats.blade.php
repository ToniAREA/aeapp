<div>
    <input type="text" class="form-control" placeholder="Search boat..." wire:model="searchTerm" />
    <ul class="list-group mt-3">
        @foreach ($resoults as $boat)
            <li class="list-group-item p-1">
                @can('boat_show')
                    <a class="text-muted" href="{{ route('admin.boats.show', $boat->id) }}">
                    @endcan
                    {{ $boat->id_boat . '- ' . $boat->type . ', ' . $boat->name }}
                    @can('boat_show')
                    </a>
                @endcan
                <span class="badge-icon" title="Number of clients related to this boat.">{{ $boat->clients->count() }}<i
                        class="fas fa-user"></i>
                </span>
            </li>
        @endforeach
    </ul>
</div>
