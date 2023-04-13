<input type="text" class="form-control" placeholder="Search marina..." wire:model="searchTerm" />
<ul class="list-group mt-3">
    @foreach ($resoults as $marina)
        <li class="list-group-item p-1">
            @can('marina_show')
                <a class="text-muted" href="{{ route('admin.marinas.show', $marina->id) }}">
                @endcan
                {{ $marina->id.'- '.$marina->name }}
                @can('marina_show')
                </a>
            @endcan
        </li>
    @endforeach
</ul>
