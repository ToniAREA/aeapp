@extends('layouts.admin')
@section('content')

    <div class="card mb-4">
        <div class="card-header ">
            @can('client_edit')
                <button class="btn btn-outline-muted btn-sm m-1 " style="float:right;">
                    <a href="{{ route('admin.clients.edit', $client->id) }}"><i class="fa fa-edit fa-lg"
                            aria-hidden="true"></i></a>
                </button>
            @endcan
            @if ($client->email)
                <button class="btn btn-outline-muted btn-sm m-1" style="float:right;">
                    <a href="mailto:{{ $client->email }}"><i class="fa fa-at fa-lg" aria-hidden="true"></i></a>
                </button>
            @endif

            @if ($client->phone)
                <button class="btn btn-outline-muted btn-sm m-1" style="float:right;">
                    <a href="tel:{{ $client->phone }}"><i class="fa fa-phone fa-lg" aria-hidden="true"></i></a>
                </button>
            @endif

            @if ($client->mobile)
                <button class="btn btn-outline-muted btn-sm m-1" style="float:right;">
                    <a href="https://wa.me/{{ $client->mobile }}" class=" text-success"><i class="fa fa-phone fa-lg"
                            aria-hidden="true"></i></a>
                </button>
            @endif


            <a href="{{ $client->link_fd }}" class="text-dark text-decoration-none" target="_blank">
                <h4 class="box-title"><i class="fa fa-user me-2" aria-hidden="true"></i>
                    <b>{{ $client->name }}</b> {{ $client->lastname }}<br>
                </h4>
            </a>
            @if ($client->defaulter)
                <h4 class="box-title text-danger"><b>DEFAULTER</b></h4>
            @endif

            @if ($client->coordinates)
                <div class="m-1 mapouter">
                    <div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas"
                            src="https://maps.google.com/maps?q={{ $client->coordinates }}&t=k&z=17&ie=UTF8&iwloc=&output=embed"
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
            @endif
        </div>

        <div class="box-body p-2 mt-2">
            @if ($client->boats->count() > 0)
                <div><b>BOATS:</b></div>
                {{--  <button class="btn btn-outline-success btn-sm m-1" data-bs-toggle="modal" data-bs-target="#CreateBoat">
                    <i class="fa fa-plus" aria-hidden="true"></i> <i class="fa fa-ship" aria-hidden="true"></i></button> --}}
                @foreach ($client->boats as $boat)
                    <a href="{{ url('boat-file/' . $boat->id) }}"
                        class="btn btn-sm btn-outline-primary m-1">{{ $boat->type . ' ' . $boat->name }}</a>
                @endforeach
                <hr>
            @endif
        </div>
        <div class="box-body p-2">
            <form method="post" action="{{ url('update-client/' . $client->id) }}">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-md-6">
                        <label>Name / Company</label>
                        <input type="text" class="form-control" name="name" value="{{ $client->name }}"
                            placeholder="Company name" disabled>
                    </div>
                    <div class="col-md-3">
                        <label>Lastname</label>
                        <input type="text" class="form-control" name="lastname" value="{{ $client->lastname }}"
                            placeholder="" disabled>
                    </div>
                    <div class="col-md-3">
                        <label>VAT</label>
                        <input type="text" class="form-control" name="vat" value="{{ $client->vat }}"
                            placeholder="" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" value="{{ $client->address }}"
                            placeholder="" disabled>
                    </div>
                    <div class="col-md-4">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" value="{{ $client->country }}"
                            placeholder="" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ $client->phone }}"
                            placeholder="" disabled>
                    </div>
                    <div class="col-md-3">
                        <label>Mobile</label>
                        <input type="text" class="form-control" name="mobile" value="{{ $client->mobile }}"
                            placeholder="" disabled>
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{ $client->email }}"
                            placeholder="" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>NOTES:</label>
                        <textarea rows="4" class="form-control" name="notes" placeholder="" disabled>{{ $client->notes }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label>INTERNAL NOTES:</label>
                        <textarea rows="4" class="form-control" name="internalnotes" placeholder="" disabled>{{ $client->internalnotes }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><a href="{{ $client->link_fd }}" class="text-decoration-none" target="_blank">Link
                                FacturaDirecta</a></label>
                        <input type="text" class="form-control" name="address" value="{{ $client->link_fd }}"
                            placeholder="" disabled>
                    </div>

                </div>

            </form>
        </div>

    </div>


 {{--    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.client.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.id') }}
                            </th>
                            <td>
                                {{ $client->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.id_client') }}
                            </th>
                            <td>
                                {{ $client->id_client }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.name') }}
                            </th>
                            <td>
                                {{ $client->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.lastname') }}
                            </th>
                            <td>
                                {{ $client->lastname }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.boats') }}
                            </th>
                            <td>
                                @foreach ($client->boats as $key => $boats)
                                    <span class="label label-info">{{ $boats->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.vat') }}
                            </th>
                            <td>
                                {{ $client->vat }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.address') }}
                            </th>
                            <td>
                                {{ $client->address }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.country') }}
                            </th>
                            <td>
                                {{ $client->country }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.email') }}
                            </th>
                            <td>
                                {{ $client->email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.phone') }}
                            </th>
                            <td>
                                {{ $client->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.mobile') }}
                            </th>
                            <td>
                                {{ $client->mobile }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.notes') }}
                            </th>
                            <td>
                                {{ $client->notes }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.internalnotes') }}
                            </th>
                            <td>
                                {{ $client->internalnotes }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.defaulter') }}
                            </th>
                            <td>
                                {{ App\Models\Client::DEFAULTER_RADIO[$client->defaulter] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.lastuse') }}
                            </th>
                            <td>
                                {{ $client->lastuse }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.link_fd') }}
                            </th>
                            <td>
                                {{ $client->link_fd }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.coordinates') }}
                            </th>
                            <td>
                                {{ $client->coordinates }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
 --}}
    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#client_wlists" role="tab" data-toggle="tab">
                    {{ trans('cruds.wlist.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#client_appointments" role="tab" data-toggle="tab">
                    {{ trans('cruds.appointment.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#client_boats" role="tab" data-toggle="tab">
                    {{ trans('cruds.boat.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="client_wlists">
                @includeIf('admin.clients.relationships.clientWlists', ['wlists' => $client->clientWlists])
            </div>
            <div class="tab-pane" role="tabpanel" id="client_appointments">
                @includeIf('admin.clients.relationships.clientAppointments', [
                    'appointments' => $client->clientAppointments,
                ])
            </div>
            <div class="tab-pane" role="tabpanel" id="client_boats">
                @includeIf('admin.clients.relationships.clientBoats', ['boats' => $client->clientBoats])
            </div>
        </div>
    </div>

@endsection
