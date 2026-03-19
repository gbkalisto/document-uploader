{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')

@push('styles')
    <style>
        .bg-light-soft {
            background-color: #f8f9fc;
            background-image: radial-gradient(#d1d9e6 0.5px, transparent 0.5px);
            background-size: 20px 20px;
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .alert-custom {
            border: none;
            border-left: 4px solid #198754;
            background-color: #f0fff4;
            color: #198754;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid min-vh-100 d-flex align-items-center bg-light-soft">
        <div class="row justify-content-center w-100">
            <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4">

                <div class="text-center mb-4">
                    <div class="bg-primary d-inline-block rounded-circle shadow-sm mb-3"
                        style="width: 60px; height: 60px; line-height: 60px;">
                        <i class="bi bi-envelope-check-fill text-white fs-3"></i>
                    </div>
                    <h3 class="fw-bold text-dark">{{ __('Verify Your Email') }}</h3>
                    <p class="text-muted small">One last step to secure your account</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">

                        @if (session('resent'))
                            <div class="alert alert-custom shadow-sm mb-4 small" role="alert">
                                <i class="bi bi-send-check-fill me-2"></i>
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <div class="text-center mb-4">
                            <p class="text-secondary">
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                            </p>
                            <p class="text-muted small">
                                {{ __('If you did not receive the email, we can send it again.') }}
                            </p>
                        </div>

                        <form class="d-grid" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm hover-lift">
                                {{ __('Resend Verification Email') }} <i class="bi bi-arrow-repeat ms-2"></i>
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link text-decoration-none text-muted small fw-bold">
                                    <i class="bi bi-box-arrow-left me-1"></i> {{ __('Logout and try another email') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <p class="text-center text-muted small mt-4">
                    &copy; {{ date('Y') }} My Solar Expert. All rights reserved.
                </p>
            </div>
        </div>
    </div>
@endsection
