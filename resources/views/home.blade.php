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
                <br><span class="px-3 bg-dark rounded-pill text-light">{{ $clients_count }}</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route('admin.boats.index') }}" class=" btn btn-sm btn-outline-dark" style="width: 100%;"
                role="button" aria-disabled="true"><i class=" fa fa-ship" aria-hidden="true"></i><br>BOATS
                <br><span class="px-3 bg-dark rounded-pill text-light">{{ $boats_count }}</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route('admin.wlists.index') }}" class=" btn btn-sm btn-outline-dark" style="width: 100%;"
                role="button" aria-disabled="true"><i class=" fa fa-list" aria-hidden="true"></i><br>WORKING
                <br><span class="px-3 bg-dark rounded-pill text-light">{{ $wlists_count }}</span>
            </a>
        </div>
        <div class="col p-1">
            <a href="{{ route('admin.wlogs.index') }}"
                class=" btn btn-sm @if ($wlogs_count > 1) btn-outline-danger
            @else
                btn-outline-dark @endif"
                style="width: 100%;" role="button" aria-disabled="true"><i class=" fa fa-edit"
                    aria-hidden="true"></i><br>NOT_CH
                <br><span
                    class="px-3 @if ($wlogs_count > 1) bg-danger
            @else
                bg-dark @endif rounded-pill text-light">{{ $wlogs_count }}</span>
            </a>
        </div>
    </div>

    <div class="row m-1">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

        <div id='calendar' class="p-1"></div>
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
                    /* center: 'title', */
                    right: 'day,workWeek,month'
                },
                views: {
                    workWeek: {
                        type: 'agendaWeek',
                        hiddenDays: [0, 6], // Hide Sunday (0) and Saturday (6)
                        buttonText: 'work week'
                    },
                    day: {
                        type: 'agendaDay',
                        buttonText: 'day'
                    }
                },
                defaultView: 'workWeek', // Set the default view to 'workWeek'
                minTime: '08:00:00', // Set the minimum time to 8 AM
                maxTime: '18:00:00', // Set the maximum time to 6 PM
                height: 600,
                nowIndicator: true,

            });
        });
    </script>
    @parent
@endsection
