@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-0">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row m-0">
                            <div class="col p-1">
                                <a href="/clients-list" class=" btn btn-sm btn-outline-dark" style="width: 100%;"
                                    role="button" aria-disabled="true"><i class=" fa fa-users"
                                        aria-hidden="true"></i><br>CLIENTS
                                    <br><span
                                        class="px-3 bg-dark rounded-pill text-light">{{ number_format($settings1['total_number']) }}</span>
                                </a>
                            </div>
                            <div class="col p-1">
                                <a href="/boats-list" class=" btn btn-sm btn-outline-dark" style="width: 100%;"
                                    role="button" aria-disabled="true"><i class=" fa fa-ship"
                                        aria-hidden="true"></i><br>BOATS
                                    <br><span
                                        class="px-3 bg-dark rounded-pill text-light">{{ number_format($settings2['total_number']) }}</span>
                                </a>
                            </div>
                            <div class="col p-1">
                                <a href="/wlist" class=" btn btn-sm btn-outline-primary" style="width: 100%;"
                                    role="button" aria-disabled="true"><i class=" fa fa-list"
                                        aria-hidden="true"></i><br>WORKING
                                    <br><span
                                        class="px-3 bg-primary rounded-pill text-light">{{ number_format($settings3['total_number']) }}</span>
                                </a>
                            </div>
                            <div class="col p-1">
                                <a href="/wlogs" class=" btn btn-sm btn-outline-danger" style="width: 100%;" role="button"
                                    aria-disabled="true"><i class=" fa fa-edit" aria-hidden="true"></i><br>NOT_CH
                                    <br><span
                                        class="px-3 bg-danger rounded-pill text-light">{{ number_format($settings4['total_number']) }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="{{ $chart5->options['column_class'] }}">
                                <h3>{!! $chart5->options['chart_title'] !!}</h3>
                                {!! $chart5->renderHtml() !!}
                            </div>
                            <div class="{{ $chart6->options['column_class'] }}">
                                <h3>{!! $chart6->options['chart_title'] !!}</h3>
                                {!! $chart6->renderHtml() !!}
                            </div>
                            {{-- Widget - latest entries --}}
                            <div class="{{ $settings7['column_class'] }}" style="overflow-x: auto;">
                                <h3>{{ $settings7['chart_title'] }}</h3>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            @foreach ($settings7['fields'] as $key => $value)
                                                <th>
                                                    {{ trans(sprintf('cruds.%s.fields.%s', $settings7['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($settings7['data'] as $entry)
                                            <tr>
                                                @foreach ($settings7['fields'] as $key => $value)
                                                    <td>
                                                        @if ($value === '')
                                                            {{ $entry->{$key} }}
                                                        @elseif(is_iterable($entry->{$key}))
                                                            @foreach ($entry->{$key} as $subEentry)
                                                                <span
                                                                    class="label label-info">{{ $subEentry->{$value} }}</span>
                                                            @endforeach
                                                        @else
                                                            {{ data_get($entry, $key . '.' . $value) }}
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ count($settings7['fields']) }}">
                                                    {{ __('No entries found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Widget - latest entries --}}
                            <div class="{{ $settings8['column_class'] }}" style="overflow-x: auto;">
                                <h3>{{ $settings8['chart_title'] }}</h3>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            @foreach ($settings8['fields'] as $key => $value)
                                                <th>
                                                    {{ trans(sprintf('cruds.%s.fields.%s', $settings8['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($settings8['data'] as $entry)
                                            <tr>
                                                @foreach ($settings8['fields'] as $key => $value)
                                                    <td>
                                                        @if ($value === '')
                                                            {{ $entry->{$key} }}
                                                        @elseif(is_iterable($entry->{$key}))
                                                            @foreach ($entry->{$key} as $subEentry)
                                                                <span
                                                                    class="label label-info">{{ $subEentry->{$value} }}</span>
                                                            @endforeach
                                                        @else
                                                            {{ data_get($entry, $key . '.' . $value) }}
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ count($settings8['fields']) }}">
                                                    {{ __('No entries found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart5->renderJs() !!}{!! $chart6->renderJs() !!}
@endsection
