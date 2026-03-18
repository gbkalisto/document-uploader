<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title> My Solar Expert | Admin Panel</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" />

    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

    @stack('styles')

    <style>
        .alert-dismissible .btn-close {
            position: absolute;
            top: 26px;
            right: 0;
            z-index: 2;
            padding: 0.25rem 1rem;
        }
    </style>
</head>

<body>
    <div id="app" class="h-100">

        {{-- SHOW NAVBAR ONLY IF LOGGED IN --}}
        @auth('admin')
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        My Solar Expert
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.customers.index') }}">{{ __('Customers') }}</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown">
                                    {{ Auth::guard('admin')->user()->first_name }}
                                    {{ strtolower(Auth::guard('admin')->user()->last_name) }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{ route('admin.profile') }}" class="dropdown-item">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            {{-- Post-Login Content (Standard Layout) --}}
            <main class="py-3 container">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center"
                        role="alert" style="border-radius: 12px; background: #d1fae5; color: #065f46;">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-check2-circle fs-5"></i>
                        </div>

                        <div class="flex-grow-1">
                            <strong class="d-block">Success!</strong>
                            <span class="small">{{ session('success') }}</span>
                        </div>

                        <button type="button" class="btn-close ms-auto shadow-none" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center"
                        role="alert" style="border-radius: 12px; background: #fee2e2; color: #991b1b;">
                        <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-exclamation-triangle fs-5"></i>
                        </div>
                        <div class="flex-grow-1">
                            <strong class="d-block">Error</strong>
                            <span class="small">{{ session('error') }}</span>
                        </div>
                        <button type="button" class="btn-close ms-auto shadow-none" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        @else
            {{-- GUEST VIEW: Perfectly Centered Content, No Navbar --}}
            <div class="guest-wrapper">
                @yield('content')
            </div>
        @endauth

    </div>
</body>
<script>
    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
@stack('scripts')

</html>
