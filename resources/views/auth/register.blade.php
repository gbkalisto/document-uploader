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

        .cursor-pointer {
            cursor: pointer;
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            border-radius: 0.5rem;
        }

        .input-group-text,
        .form-control {
            border-color: #dee2e6;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid min-vh-80 d-flex align-items-center bg-light-soft">
        <div class="row justify-content-center w-100">
            <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4">

                <div class="text-center mb-4">
                    <div class="bg-primary d-inline-block rounded-circle shadow-sm mb-3"
                        style="width: 60px; height: 60px; line-height: 60px;">
                        <i class="bi bi-person-plus-fill text-white fs-3"></i>
                    </div>
                    <h3 class="fw-bold text-dark">Create Account</h3>
                    <p class="text-muted small">Join us to start managing your documents</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label small fw-bold text-uppercase text-secondary">Full
                                    Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input id="name" type="text"
                                        class="form-control border-start-0 ps-0 py-2 @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="John Doe">
                                </div>
                                @error('name')
                                    <span class="text-danger small mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label small fw-bold text-uppercase text-secondary">Email
                                    Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="email" type="email"
                                        class="form-control border-start-0 ps-0 py-2 @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="name@example.com">
                                </div>
                                @error('email')
                                    <span class="text-danger small mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password"
                                    class="form-label small fw-bold text-uppercase text-secondary">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input id="password" type="password"
                                        class="form-control border-start-0 border-end-0 ps-0 py-2 @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password" placeholder="••••••••">
                                    <button
                                        class="input-group-text bg-white border-start-0 text-muted cursor-pointer toggle-password"
                                        type="button" data-target="password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="text-danger small mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password-confirm"
                                    class="form-label small fw-bold text-uppercase text-secondary">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">
                                        <i class="bi bi-check2-circle"></i>
                                    </span>
                                    <input id="password-confirm" type="password"
                                        class="form-control border-start-0 border-end-0 ps-0 py-2"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="••••••••">
                                    <button
                                        class="input-group-text bg-white border-start-0 text-muted cursor-pointer toggle-password"
                                        type="button" data-target="password-confirm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm hover-lift">
                                    Create Account <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <span class="text-muted small">Already have an account?</span>
                                <a href="{{ route('login') }}" class="small fw-bold text-decoration-none">Sign In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-password');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
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
@endsection
