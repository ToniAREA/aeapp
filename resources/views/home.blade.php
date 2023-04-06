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
            <a href="{{ route('admin.clients.index') }}" class=" btn btn-sm btn-outline-dark" style="width: 100%;"
                role="button" aria-disabled="true"><i class=" fa fa-users" aria-hidden="true"></i><br>CLIENTS
                <br><span class="px-3 bg-dark rounded-pill text-light">{{ $clients->count() }}</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route('admin.boats.index') }}" class=" btn btn-sm btn-outline-dark" style="width: 100%;"
                role="button" aria-disabled="true"><i class=" fa fa-ship" aria-hidden="true"></i><br>BOATS
                <br><span class="px-3 bg-dark rounded-pill text-light">{{ $boats->count() }}</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route('admin.wlists.index') }}" class=" btn btn-sm btn-outline-dark" style="width: 100%;"
                role="button" aria-disabled="true"><i class=" fa fa-list" aria-hidden="true"></i><br>WORKING
                <br><span class="px-3 bg-dark rounded-pill text-light">88</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route('admin.wlogs.index') }}" class=" btn btn-sm btn-outline-danger" style="width: 100%;"
                role="button" aria-disabled="true"><i class=" fa fa-edit" aria-hidden="true"></i><br>NOT_CH
                <br><span class="px-3 bg-danger rounded-pill text-light">7</span>
            </a>
        </div>
    </div>

    <div class="row m-1">
        <div class="col p-1">
            <a href="{{ route('admin.clients.create') }}" class=" btn btn-sm btn-dark" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-plus" aria-hidden="true"></i> CLIENT
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route('admin.boats.create') }}" class=" btn btn-sm btn-dark" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-plus" aria-hidden="true"></i> BOAT
            </a>
        </div>
    </div>

    <div class="row m-1">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

        <div id='calendar'></div>
    </div>

     <div class="row m-1">
        <div class="col p-1">
            <a href="{{ route('admin.to-dos.create') }}" class=" btn btn-sm btn-dark" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-plus" aria-hidden="true"></i>TO DO
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route('admin.appointments.create') }}" class=" btn btn-sm btn-dark" style="width: 100%;" role="button"
                aria-disabled="true"><i class=" fa fa-plus" aria-hidden="true"></i>APPOINTMENT
            </a>
        </div>
    </div>

@endsection
@section('scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            events = {!! json_encode($events) !!};
            // Initialize the FullCalendar plugin
            $('#calendar').fullCalendar({
                // Put your options and callbacks here
                events: events,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'workWeek,agendaWeek,month'
                },
                views: {
                    workWeek: {
                        type: 'agendaWeek',
                        hiddenDays: [0, 6], // Hide Sunday (0) and Saturday (6)
                        buttonText: 'Work week'
                    }
                },
                defaultView: 'workWeek' // Set the default view to 'workWeek'
            });
        });
    </script>
    @parent
@endsection
