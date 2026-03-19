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

        /* Essential for the Eye Icon to work */
        .password-toggle-btn {
            cursor: pointer !important;
            z-index: 10 !important;
            /* Stays above the input focus ring */
            background-color: #fff !important;
            border-left: none !important;
            border-radius: 0 0.5rem 0.5rem 0 !important;
        }

        .input-group-text {
            border-radius: 0.5rem 0 0 0.5rem;
        }

        .form-control {
            border-radius: 0 0.5rem 0.5rem 0;
        }

        /* Ensures the 'Confirm' field looks identical to the first one */
        .input-group>.form-control:not(:last-child) {
            border-radius: 0;
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
            <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4">

                <div class="text-center mb-4">
                    {{-- <div class="bg-primary d-inline-block rounded-circle shadow-sm mb-3"
                        style="width: 60px; height: 60px; line-height: 60px;">
                        <i class="bi bi-shield-lock-fill text-white fs-3"></i>
                    </div> --}}
                    <h3 class="fw-bold text-dark">{{ __('Reset Password') }}</h3>
                    <p class="text-muted small">Update your account with a new secure password</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-4">
                                <label for="email"
                                    class="form-label small fw-bold text-uppercase text-secondary">{{ __('Email Address') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="email" type="email"
                                        class="form-control border-start-0 ps-0 py-2 @error('email') is-invalid @enderror"
                                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                        autofocus>
                                </div>
                                @error('email')
                                    <span class="text-danger small mt-1 d-block"
                                        role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password"
                                    class="form-label small fw-bold text-uppercase text-secondary">{{ __('New Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input id="password" type="password"
                                        class="form-control border-start-0 border-end-0 ps-0 py-2 @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password" placeholder="••••••••">
                                    <button class="input-group-text password-toggle-btn text-muted" type="button">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="text-danger small mt-1 d-block"
                                        role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password-confirm"
                                    class="form-label small fw-bold text-uppercase text-secondary">{{ __('Confirm Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">
                                        <i class="bi bi-check-circle"></i>
                                    </span>
                                    <input id="password-confirm" type="password"
                                        class="form-control border-start-0 border-end-0 ps-0 py-2"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="••••••••">
                                    <button class="input-group-text password-toggle-btn text-muted" type="button">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm hover-lift">
                                    {{ __('Update Password') }} <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('click', function(event) {
            // Find the button that was clicked
            const btn = event.target.closest('.password-toggle-btn');

            if (btn) {
                event.preventDefault(); // Stop form from doing anything weird

                // Navigate to the input in the same group
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
