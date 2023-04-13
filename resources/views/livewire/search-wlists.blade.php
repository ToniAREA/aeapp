<div>
    <input type="text" class="form-control" placeholder="Search wlist..." wire:model="searchTerm" />
    <ul class="list-group mt-3">
        @foreach ($resoults as $wlist)
            <li class="list-group-item p-1">
                @can('wlist_show')
                    <a class="text-muted" href="{{ route('admin.wlists.show', $wlist->id) }}">
                        @endcan{{ '('.$wlist->client->name.') '.strtoupper($wlist->boat->type) . ' '.strtoupper($wlist->boat->name) .': '. $wlist->desciption}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>