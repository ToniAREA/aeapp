@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card mx-3">
                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

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

                        {{-- <p class="text-muted">{{ trans('global.register') }}</p> --}}

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user fa-fw"></i>
                                </span>
                            </div>
                            <input type="text" name="name"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus
                                placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-envelope fa-fw"></i>
                                </span>
                            </div>
                            <input type="email" name="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                                placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock fa-fw"></i>
                                </span>
                            </div>
                            <input type="password" name="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required
                                placeholder="{{ trans('global.login_password') }}">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock fa-fw"></i>
                                </span>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control" required
                                placeholder="{{ trans('global.login_password_confirmation') }}">
                        </div>

                        <button class="btn btn-block btn-primary">
                            {{ trans('global.register') }}
                        </button>

                        <div class="text-center mt-3">
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ trans('global.have_an_account') }}
                            </a><br>
                            <a class="btn btn-link" href="{{ url('/') }}">
                                {{ trans('global.getmeout') }}
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
