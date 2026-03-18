@extends('admin.layouts.app')
@push('styles')
    <style>
        /* 1. Ensure the background is always full height */
        html,
        body {
            height: 100%;
            margin: 0;
            background-color: #ffffff;
        }

        /* 2. This class only applies when NOT logged in to center the form */
        .guest-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100%;
        }

        /* 3. Your custom card styling */
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
            border: 1px solid #f0f0f0;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            background: white;
        }

        .btn-dark {
            background-color: #1a1a1a;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
        }

        .form-control {
            background-color: #f9f9f9;
            border: 1px solid #ededed;
            padding: 12px;
            border-radius: 10px;
        }
    </style>
@endpush
@section('content')
    <div class="login-card">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-dark">Admin Login</h4>
            <p class="text-muted small">Access your dashboard</p>
        </div>
        <form action="{{ route('admin.post.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label small fw-semibold text-secondary">Email Address</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="admin@example.com" value="{{ old('email') }}" autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="••••••••"
                        style="border-right: none;">

                    <span class="input-group-text bg-light" id="togglePassword"
                        style="cursor: pointer; border-left: none; border-radius: 0 10px 10px 0; border-color: #ededed;">
                        <i class="bi bi-eye-slash" id="eyeIcon"></i>
                    </span>

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label small text-muted" for="remember">Remember me</label>
                </div>
                <a href="#" class="small text-decoration-none text-muted">Forgot password?</a>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-dark">Login</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the icon
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
    </script>
@endpush
