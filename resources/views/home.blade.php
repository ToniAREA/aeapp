@extends('layouts.admin')
@section('content')
    @if (session('status'))
        <div class="row">
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        </div>
    @endif

    <div class="row m-1">
        <div class="col p-1">
            <a href="{{ route("admin.clients.index") }}" class=" btn btn-sm btn-outline-dark" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-users" aria-hidden="true"></i><br>CLIENTS
                <br><span class="px-3 bg-dark rounded-pill text-light">{{ $clients->count() }}</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route("admin.boats.index") }}" class=" btn btn-sm btn-outline-dark" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-ship" aria-hidden="true"></i><br>BOATS
                <br><span class="px-3 bg-dark rounded-pill text-light">{{ $boats->count() }}</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route("admin.wlists.index") }}" class=" btn btn-sm btn-outline-dark" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-list" aria-hidden="true"></i><br>WORKING
                <br><span class="px-3 bg-dark rounded-pill text-light">88</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route("admin.wlogs.index") }}" class=" btn btn-sm btn-outline-danger" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-edit" aria-hidden="true"></i><br>NOT_CH
                <br><span class="px-3 bg-danger rounded-pill text-light">7</span>
            </a>
        </div>
    </div>
    <div class="row m-1">
        <div class="col p-1">
            <a href="{{ route("admin.clients.create") }}" class=" btn btn-sm btn-outline-dark" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-plus" aria-hidden="true"></i>ADD CLIENT
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route("admin.boats.create") }}" class=" btn btn-sm btn-outline-dark" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-plus" aria-hidden="true"></i>ADD BOAT
            </a>
        </div>
        
    </div>
@endsection
@section('scripts')
    @parent
@endsection
