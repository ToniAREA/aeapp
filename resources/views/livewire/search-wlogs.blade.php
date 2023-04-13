<div>
    <input type="text" class="form-control" placeholder="Search wlog..." wire:model="searchTerm" />
    <ul class="list-group mt-3">
        @foreach ($resoults as $wlog)
            <li class="list-group-item p-1">
                @can('wlog_show')
                    <a class="text-muted" href="{{ route('admin.wlogs.show', $wlog->id) }}">
                        @endcan{{ 
                        '('.
                        $wlog->wlist->client->name .') '.
                        strtoupper($wlog->wlist->boat->type) . ' ' .
                        strtoupper($wlog->wlist->boat->name) . ': '}}
                        <br>
                        {{$wlog->wlist->desciption . ': ' }}
                        <br>
                        {{$wlog->description}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>