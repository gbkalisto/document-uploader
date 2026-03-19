@extends('layouts.app')

@push('styles')
    <style>
        /* Modern Soft Background */
        .bg-light-soft {
            background-color: #f8f9fc;
            background-image: radial-gradient(#d1d9e6 0.5px, transparent 0.5px);
            background-size: 20px 20px;
        }

        /* Card & Animation */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        /* Input Group Customization */
        .input-group-text {
            border-radius: 0.5rem 0 0 0.5rem;
            background-color: #ffffff;
        }

        .form-control {
            border-radius: 0 0.5rem 0.5rem 0;
            z-index: 1; /* Keep input below the button z-index */
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
            z-index: 1;
        }

        /* The Toggle Button Fix */
        .password-toggle-btn {
            cursor: pointer !important;
            z-index: 10 !important; /* Higher than input focus */
            border-left: none !important;
            border-radius: 0 0.5rem 0.5rem 0 !important;
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            border-radius: 0.5rem;
        }

        .cursor-pointer { cursor: pointer; }
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
                    <h3 class="fw-bold text-dark">Welcome Back</h3>
                    <p class="text-muted small">Enter your credentials to access your account</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label small fw-bold text-uppercase text-secondary">Email Address</label>
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
                                    <span class="text-danger small mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="form-label small fw-bold text-uppercase text-secondary">Password</label>
                                    @if (Route::has('password.request'))
                                        <a class="text-decoration-none small fw-semibold" href="{{ route('password.request') }}">Forgot?</a>
                                    @endif
                                </div>
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
                                    <span class="text-danger small mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input cursor-pointer" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label small text-muted cursor-pointer" for="remember">Keep me logged in</label>
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm hover-lift">
                                    Sign In <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>

                            <div class="text-center">
                                <span class="text-muted small">Don't have an account?</span>
                                <a href="{{ route('register') }}" class="small fw-bold text-decoration-none">Create one</a>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Select all toggle buttons (works for login and register)
            const toggleBtns = document.querySelectorAll('.password-toggle-btn');

            toggleBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Find the input within the same input-group
                    const input = this.closest('.input-group').querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.replace('bi-eye', 'bi-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.replace('bi-eye-slash', 'bi-eye');
                    }
                });
            });
        });
    </script>
@endpush
