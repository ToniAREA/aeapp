@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card m-1 mb-3">



            <div class="card-header">

                @can('boat_edit')
                    <a href="{{ route('admin.boats.edit', $boat->id) }}" class="btn btn-outline-muted btn-sm m-1" style="float:right;">
                    <i class="fa fa-edit fa-lg" aria-hidden="true"></i>
                </a>
                @endcan

                

                <h4 class="box-title"><i class="fa fa-ship me-2" aria-hidden="true"></i>
                    <b class="text-primary">{{ $boat->type . ' ' . $boat->name }}</b>
                </h4>
                <h5 {{-- class="@if ($boat->client->defaulter == 'on') {
                        text-danger
                    } @endif" --}}>

                    @if (auth()->user()->role == 'root' or auth()->user()->role == 'admin')
                        @if ($boat->client->link_fd)
                            <a href="{{ $boat->client->link_fd }}" class="text-decoration-none badge bg-secondary"
                                target="_blank">FD</a>
                        @endif
                    @endif

                    {{-- <a href="{{ url('client-file/' . $boat->client_id) }}"
                        class="text-decoration-none text-muted">{{ $boat->client->name . ' ' . $boat->client->lastname . ' (' . $boat->client->vat . ' - ' . $boat->client->country . ')' }}
                    </a> --}}

                </h5>




                @if (!empty($boat->mmsi))
                    <div class="col-xl-6 col-md-6">

                        <a href="https://www.marinetraffic.com/es/ais/details/ships/mmsi:{{ $boat->mmsi }}"
                            target="_blank">
                            <img class="img-thumbnail rounded mx-auto" style="max-height: 300px"
                                src="https://photos.marinetraffic.com/ais/showphoto.aspx?mmsi={{ $boat->mmsi }}"
                                alt="{{ $boat->type . ' ' . $boat->name }}"></a>
                    </div>
                @endif

                <div class="btn-group d-flex m-1" data-toggle="buttons">

                    <button class="btn btn-outline-primary btn-sm col-6" data-bs-toggle="modal"
                        data-bs-target="#CreateWlist">
                        <i class="fa fa-plus" aria-hidden="true"></i> BOAT's REQUEST
                    </button>

                    <button class="btn btn-outline-primary btn-sm col-6" data-bs-toggle="modal"
                        data-bs-target="#CreateAppointment">
                        <i class="fa fa-clock" aria-hidden="true"></i> APPOINTMENT
                    </button>

                </div>

                {{-- @if ($boat_marina)
                    <div class="mt-2">
                        <a href="{{ url('marina-file/' . $boat->marina_id) }}"
                            class="text-decoration-none text-muted">{{ $boat_marina->name }}</a>
                    @else
                        Need to set marina!.
                @endif --}}

                {{--  @if ($boat_marina and $boat_marina->coordinates)
                    <div class="m-1">
                        <div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas"
                                src="https://maps.google.com/maps?q={{ $boat_marina->coordinates }}&t=k&z=17&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><br>
                            <style>
                                .mapouter {
                                    position: relative;
                                    text-align: center;
                                    height: 300px;
                                    width: 100%;
                                }
                            </style>
                            <style>
                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 300px;
                                    width: 100%;
                                }
                            </style>
                        </div>

                    </div>
                @else
                    No GPS coordinates!
                @endif --}}
            </div>

            @if (!empty($boat->notes))
                NOTES: {{ $boat->notes }}<br>
            @endif
            @if (!empty($boat->internalnotes))
                INTERNAL NOTES: {{ $boat->internalnotes }}
            @endif

        </div>


        <div class="text-muted text-center fs-5 mb-2">PENDING or WORKING</div>

        <div class="row justify-content-center">
            @foreach ($boat->boatWlists as $wl)
                <div class="col-xl-4 col-md-6 m-2">
                    <div class="card bg-light text-dark mb-2">
                        <div class="card-header">

                            {{-- <div class="text-muted mb-1">
                                Appointment: {{ \Carbon\Carbon::parse($wl->next_appointment)->diffForHumans() }}</a>
                            </div> --}}

                            <div class="row d-flex align-items-center justify-content-center mt-0">
                                @if ($wl->type == 'estimate')
                                    <span class="badge bg-info me-1" style="width: 22%;">ESTIMATE</span>
                                @else
                                    <span class="badge bg-clear me-1" style="width: 22%;">ESTIMATE</span>
                                @endif
                                @if ($wl->type == 'order')
                                    <span class="badge bg-danger me-1" style="width: 22%;">ORDER</span>
                                @else
                                    <span class="badge bg-clear me-1" style="width: 22%;">ORDER</span>
                                @endif
                                @if ($wl->type == 'work')
                                    <span class="badge bg-success me-1" style="width: 22%;">WORK</span>
                                @else
                                    <span class="badge bg-clear me-1" style="width: 22%;">WORK</span>
                                @endif
                                @if ($wl->status == 'done')
                                    <span class="badge bg-secondary me-1" style="width: 29%;">DONE</span>
                                @else
                                    <span class="badge bg-clear me-1" style="width: 29%;">DONE</span>
                                @endif
                            </div> <a class="text-decoration-none text-muted"
                                href="{{ url('wlist-file/' . $wl->id) }}"><b>{{ 'WLIST-' . $wl->id }}</b>
                                {{ '(' . $wl->assigned . ') ' }}</a>
                            <b><a class="text-decoration-none @if ($wl->deadline < now()) text-danger @else text-muted @endif"
                                    href="{{ url('boat-file/' . $wl->boat_id) }}"
                                    style="float:right;">{{ 'DL: ' . $wl->deadline }}</a></b>
                            <br>

                            <a class="text-decoration-none text-muted" href="{{ url('wlist-file/' . $wl->id) }}"><i
                                    class="fa fa-angle-right" aria-hidden="true"></i>{{ $wl->id }}
                                <br>

                                {{-- With the following we can check for WLOGS DONE NOT charged related to this WLIST --}}
                                @if (!$boat->boatWlists->where('wlist_id', '=', $wl->id)->where('status', '!=', 'charged')->isEmpty())
                                    <span class="mt-2 badge bg-danger ms-1" style="width: 100%;">
                                        WLOGs NOT CHARGED!
                                    </span>
                                @endif

                            </a>
                            {{-- <a href="{{ url('wlist-file/' . $wl->id) }}"><i class="fa fa-edit" aria-hidden="true"
                                    style="float: right;"></i></a> --}}

                            @if ($boat->boatWlists->where('wlist_id', '=', $wl->id)->sum('hours') > 0)
                                <span class="mt-2 badge bg-secondary ms-1" style="width: 200px; float:left;">
                                    {{ 'TOTAL TIME = ' . $boat->boatWlists->where('wlist_id', '=', $wl->id)->sum('hours') . 'h' }}
                                </span>
                            @endif

                            @if (count($boat->boatWlists->where('wlist_id', '=', $wl->id)) >= 1)
                                <span class="mt-2 badge bg-secondary ms-1" style="width: 50px; float:right;">
                                    {{ 'WL: ' . count($boat->boatWlists->where('wlist_id', '=', $wl->id)) }}
                                </span>
                            @endif

                            {{--  @if (count($wcomms->where('wlist_id', '=', $wl->id)) >= 1)
                                <span class="mt-2 badge bg-info" style="width: 50px; float:right;">
                                    {{ 'C: ' . count($wcomms->where('wlist_id', '=', $wl->id)) }}
                                </span>
                            @endif --}}

                        </div>{{-- <div class="card-body p-2 bg-white">
                            
                            @if ($wlogs->where('wlist_id', '=', $wl->id)->sum('hours') > 0)
                                <span class="mt-2 badge bg-secondary ms-1" style="width: 200px; float:left;">
                                    {{ 'TOTAL TIME = ' . $wlogs->where('wlist_id', '=', $wl->id)->sum('hours') . 'h' }}
                                </span>
                            @endif

                            @if (count($wlogs->where('wlist_id', '=', $wl->id)) >= 1)
                                <span class="mt-2 badge bg-secondary ms-1" style="width: 50px; float:right;">
                                    {{ 'WL: ' . count($wlogs->where('wlist_id', '=', $wl->id)) }}
                                </span>
                            @endif

                            @if (count($wcomms->where('wlist_id', '=', $wl->id)) >= 1)
                                <span class="mt-2 badge bg-info" style="width: 50px; float:right;">
                                    {{ 'C: ' . count($wcomms->where('wlist_id', '=', $wl->id)) }}
                                </span>
                            @endif


                            <br>
                        </div> --}}
                    </div>
                </div>
            @endforeach
        </div>

        <hr>

        <div class="text-muted text-center fs-5 mb-2">WORKS DONE</div>

        <div class="row justify-content-center">
            @foreach ($boat->boatWlists->where('status', '=', 'done') as $wl)
                <div class="col-xl-4 col-md-6">


                    <div class="card bg-light text-dark mb-2">
                        <div class="card-header">



                            {{--                            @switch(true)
                                @case($wl->type == 'estimate')
                                    <span class="badge bg-info" style="width: 60px;">ESTIM.</span>
                                @break

                                @case($wl->type == 'order')
                                    <span class="badge bg-danger" style="width: 60px;">ORDER</span>
                                @break

                                @case($wl->type == 'work')
                                    <span class="badge bg-success" style="width: 60px;">WORK</span>
                                @break
                            @endswitch


                             @switch(true)
                                @case($wl->status == 'pending')
                                    <span class="badge bg-warning" style="width: 60px;">PEND.</span>
                                @break

                                @case($wl->status == 'done')
                                    <span class="badge bg-secondary" style="width: 60px;">DONE</span>
                                @break

                                @case($wl->status == 'working')
                                    <span class="badge bg-success" style="width: 60px;">WORK...</span>
                                @break

                                @case($wl->status == 'paid')
                                    <span class="badge bg-light" style="width: 60px;">PAID</span>
                                @break
                            @endswitch --}}

                            <a class="text-decoration-none text-muted"
                                href="{{ url('wlist-file/' . $wl->id) }}"><b>{{ 'WLIST-' . $wl->id }}</b>
                                {{ '(' . $wl->assigned . ') ' }}<br><i class="fa fa-angle-right"
                                    aria-hidden="true"></i>{{ $wl->description }}
                                <br>

                                {{-- With the following we can check for WLOGS DONE NOT charged related to this WLIST --}}
                                @if (!$wlogs->where('wlist_id', '=', $wl->id)->where('status', '=', 'done')->isEmpty())
                                    <span class="mt-2 badge bg-danger ms-1" style="width: 100%;">
                                        WLOGs DONE NOT CHARGED!
                                    </span>
                                @endif

                            </a>
                            {{-- <a href="{{ url('wlist-file/' . $wl->id) }}"><i class="fa fa-edit" aria-hidden="true"
                                    style="float: right;"></i></a> --}}

                            @if ($wlogs->where('wlist_id', '=', $wl->id)->sum('hours') > 0)
                                <span class="mt-2 badge bg-secondary ms-1" style="width: 200px; float:left;">
                                    {{ 'TOTAL TIME = ' . $wlogs->where('wlist_id', '=', $wl->id)->sum('hours') . 'h' }}
                                </span>
                            @endif

                            @if (count($wlogs->where('wlist_id', '=', $wl->id)) >= 1)
                                <span class="mt-2 badge bg-secondary ms-1" style="width: 50px; float:right;">
                                    {{ 'WL: ' . count($wlogs->where('wlist_id', '=', $wl->id)) }}
                                </span>
                            @endif

                            @if (count($wcomms->where('wlist_id', '=', $wl->id)) >= 1)
                                <span class="mt-2 badge bg-info" style="width: 50px; float:right;">
                                    {{ 'C: ' . count($wcomms->where('wlist_id', '=', $wl->id)) }}
                                </span>
                            @endif

                        </div>{{-- <div class="card-body p-2 bg-white">
                            
                            @if ($wlogs->where('wlist_id', '=', $wl->id)->sum('hours') > 0)
                                <span class="mt-2 badge bg-secondary ms-1" style="width: 200px; float:left;">
                                    {{ 'TOTAL TIME = ' . $wlogs->where('wlist_id', '=', $wl->id)->sum('hours') . 'h' }}
                                </span>
                            @endif

                            @if (count($wlogs->where('wlist_id', '=', $wl->id)) >= 1)
                                <span class="mt-2 badge bg-secondary ms-1" style="width: 50px; float:right;">
                                    {{ 'WL: ' . count($wlogs->where('wlist_id', '=', $wl->id)) }}
                                </span>
                            @endif

                            @if (count($wcomms->where('wlist_id', '=', $wl->id)) >= 1)
                                <span class="mt-2 badge bg-info" style="width: 50px; float:right;">
                                    {{ 'C: ' . count($wcomms->where('wlist_id', '=', $wl->id)) }}
                                </span>
                            @endif

                            <br>
                        </div> --}}
                    </div>
                </div>
            @endforeach
        </div>
        <hr>

        <div class="text-muted text-center fs-5">WLOGS HISTORICAL RECORD<br>

        </div>

        <div class="text-muted text-center fs-3 mb-2">
            {{ 'TOTAL TIME = ' . $boat->boatWlists->sum('hours') . 'h' }}
        </div>

        @foreach ($boat->boatWlists as $wl)
            <i class="fa fa-angle-right" aria-hidden="true"></i><a
                class="text-decoration-none 
            
            @if ($wl->status != 'charged') text-danger
            @else
                text-muted @endif

            "
                href="{{ url('wlist-file/' . $wl->wlist_id) }}">
                {{ $wl->status . '> ' . $wl->date . ': ' . $wl->employee_name . ' (' . $wl->hours . 'h): ' }}
                {{ $wl->description }}</a><br>
        @endforeach


        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.boats.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.boat.fields.id') }}
                            </th>
                            <td>
                                {{ $boat->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.boat.fields.id_boat') }}
                            </th>
                            <td>
                                {{ $boat->id_boat }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.boat.fields.type') }}
                            </th>
                            <td>
                                {{ $boat->type }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.boat.fields.name') }}
                            </th>
                            <td>
                                {{ $boat->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.boat.fields.marina') }}
                            </th>
                            <td>
                                {{ $boat->marina->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.boat.fields.client') }}
                            </th>
                            <td>
                                @foreach ($boat->clients as $key => $client)
                                    <span class="label label-info">{{ $client->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.boat.fields.mmsi') }}
                            </th>
                            <td>
                                {{ $boat->mmsi }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.boat.fields.notes') }}
                            </th>
                            <td>
                                {{ $boat->notes }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.boat.fields.internalnotes') }}
                            </th>
                            <td>
                                {{ $boat->internalnotes }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.boat.fields.lastuse') }}
                            </th>
                            <td>
                                {{ $boat->lastuse }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.boats.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#boat_wlists" role="tab" data-toggle="tab">
                    {{ trans('cruds.wlist.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#boats_clients" role="tab" data-toggle="tab">
                    {{ trans('cruds.client.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#boats_marinas" role="tab" data-toggle="tab">
                    {{ trans('cruds.marina.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="boat_wlists">
                @includeIf('admin.boats.relationships.boatWlists', ['wlists' => $boat->boatWlists])
            </div>
            <div class="tab-pane" role="tabpanel" id="boats_clients">
                @includeIf('admin.boats.relationships.boatsClients', ['clients' => $boat->boatsClients])
            </div>
            <div class="tab-pane" role="tabpanel" id="boats_marinas">
                @includeIf('admin.boats.relationships.boatsMarinas', ['marinas' => $boat->boatsMarinas])
            </div>
        </div>
    </div>

@endsection
