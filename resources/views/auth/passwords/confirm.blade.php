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

        /* Eye Toggle Button Fix */
        .password-toggle-btn {
            cursor: pointer !important;
            z-index: 10 !important;
            background-color: #fff !important;
            border-left: none !important;
            border-radius: 0 0.5rem 0.5rem 0 !important;
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
    <div class="container-fluid min-vh-80 d-flex align-items-center bg-light-soft">
        <div class="row justify-content-center w-100">
            <div class="col-11 col-sm-8 col-md-6 col-lg-4">

                <div class="text-center mb-4">
                    <div class="bg-primary d-inline-block rounded-circle shadow-sm mb-3"
                        style="width: 60px; height: 60px; line-height: 60px;">
                        <i class="bi bi-shield-lock-fill text-white fs-3"></i>
                    </div>
                    <h3 class="fw-bold text-dark">{{ __('Confirm Password') }}</h3>
                    <p class="text-muted small">{{ __('Please confirm your password before continuing.') }}</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="password"
                                    class="form-label small fw-bold text-uppercase text-secondary">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 text-muted">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input id="password" type="password"
                                        class="form-control border-start-0 border-end-0 ps-0 py-2 @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password" placeholder="••••••••">
                                    <button class="input-group-text password-toggle-btn text-muted" type="button">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="text-danger small mt-1 d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm hover-lift">
                                    {{ __('Confirm Password') }} <i class="bi bi-check2-circle ms-2"></i>
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-decoration-none small fw-semibold"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
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

@push('scripts')
    <script>
        // Universal eye toggle logic
        document.addEventListener('click', function(event) {
            const btn = event.target.closest('.password-toggle-btn');
            if (btn) {
                event.preventDefault();
                const inputGroup = btn.closest('.input-group');
                const input = inputGroup.querySelector('input');
                const icon = btn.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('bi-eye', 'bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('bi-eye-slash', 'bi-eye');
                }
            }
        });
    </script>
@endpush
