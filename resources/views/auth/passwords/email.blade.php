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

        .input-group-text {
            border-radius: 0.5rem 0 0 0.5rem;
            background-color: #ffffff;
        }

        .form-control {
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            border-radius: 0.5rem;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid min-vh-100 d-flex align-items-center bg-light-soft">
        <div class="row justify-content-center w-100">
            <div class="col-11 col-sm-8 col-md-6 col-lg-4">

                <div class="text-center mb-4">
                    {{-- <div class="bg-primary d-inline-block rounded-circle shadow-sm mb-3"
                        style="width: 60px; height: 60px; line-height: 60px;">
                        <i class="bi bi-envelope-paper-fill text-white fs-3"></i>
                    </div> --}}
                    <h3 class="fw-bold text-dark">Reset Password</h3>
                    <p class="text-muted small">We'll send a recovery link to your inbox</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">

                        @if (session('status'))
                            <div class="alert alert-success border-0 shadow-sm mb-4 small" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label small fw-bold text-uppercase text-secondary">Email
                                    Address</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 text-muted">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="email" type="email"
                                        class="form-control border-start-0 ps-0 py-2 @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="name@example.com">
                                </div>
                                @error('email')
                                    <span class="text-danger small mt-1 d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm hover-lift">
                                    Send Reset Link <i class="bi bi-send ms-2"></i>
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('login') }}" class="small fw-bold text-decoration-none">
                                    <i class="bi bi-arrow-left me-1"></i> Back to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center text-muted small mt-4">
                    &copy; {{ date('Y') }} My Solar Expert. All rights reserved.
                </p>
            </div>
        </div>
    </div>
@endsection
