@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-body p-4">

                    <div class="logo-container">
                            @php
                                $logoPath = public_path('images/logos/logo.png');
                            @endphp

                            @if (file_exists($logoPath))
                                <img src="{{ asset('images/logos/logo.png') }}" alt="Logo" class="logo" />
                            @else
                                <h1 class="text-center">{{ trans('panel.site_title') }}</h1>
                            @endif
                        </div>

                    {{-- <p class="text-muted">{{ trans('global.reset_password') }}</p> --}}

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <input id="email" type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required
                                autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}"
                                value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-flat btn-block">
                                    {{ trans('global.send_password') }}
                                </button>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ trans('global.have_an_account') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection