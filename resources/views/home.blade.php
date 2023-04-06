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
            <a href="/clients-list" class=" btn btn-sm btn-outline-primary" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-users" aria-hidden="true"></i><br>CLIENTS
                <br><span class="px-3 bg-primary rounded-pill text-light">500</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="/boats-list" class=" btn btn-sm btn-outline-primary" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-ship" aria-hidden="true"></i><br>BOATS
                <br><span class="px-3 bg-primary rounded-pill text-light">300</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="/wlist" class=" btn btn-sm btn-outline-primary" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-list" aria-hidden="true"></i><br>WORKING
                <br><span class="px-3 bg-primary rounded-pill text-light">88</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="/wlogs" class=" btn btn-sm btn-outline-danger" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-edit" aria-hidden="true"></i><br>NOT_CH
                <br><span class="px-3 bg-danger rounded-pill text-light">7</span>
            </a>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
