<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Solar Expert | Admin Panel</title>

    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%232563eb%22><path d=%22M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z%22/></svg>">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

    @stack('styles')

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
        }

        /* Modern Navbar Styling */
        .navbar {
            padding: 0.8rem 0;
            background-color: #FDFDFC !important;
            border-bottom: 1px solid #f1f1f1;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-icon {
            background-color: #2563eb;
            /* Exact Blue-600 from User Side */
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .admin-tag {
            font-size: 0.65rem;
            text-transform: uppercase;
            background: #eef2ff;
            color: #2563eb;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 700;
            margin-left: 8px;
        }

        .nav-link {
            font-weight: 500;
            color: #475569 !important;
            transition: all 0.2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #2563eb !important;
        }

        .guest-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fc;
            background-image: radial-gradient(#d1d9e6 0.5px, transparent 0.5px);
            background-size: 20px 20px;
        }

        .alert-dismissible .btn-close {
            position: absolute;
            top: 12px;
            right: 0;
            z-index: 2;
            padding: 1.25rem 1rem;
        }
    </style>
</head>

<body>
    <div id="app" class="h-100">

        @auth('admin')
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-none">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        <div class="brand-icon">
                            <i class="bi bi-file-earmark-arrow-up-fill" style="font-size: 1rem;"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="lh-1">My Solar Expert</span>
                            <span class="admin-tag lh-1 mt-1">Admin Panel</span>
                        </div>
                    </a>

                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto ms-lg-4">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.customers.index') }}">
                                    <i class="bi bi-people me-1"></i> {{ __('Customers') }}
                                </a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ms-auto align-items-center">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                    class="nav-link dropdown-toggle fw-bold d-flex align-items-center gap-2" href="#"
                                    role="button" data-bs-toggle="dropdown">
                                    {{-- <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="bi bi-person-circle text-primary"></i>
                                    </div> --}}
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center overflow-hidden"
                                        style="width: 32px; height: 32px; border: 1px solid #eef2ff;">
                                        @if (Auth::guard('admin')->user()->profile_picture)
                                            <img src="{{ asset('storage/' . Auth::guard('admin')->user()->profile_picture) }}"
                                                alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="bi bi-person-circle text-primary"></i>
                                        @endif
                                    </div>
                                    {{ Auth::guard('admin')->user()->last_name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 mt-2"
                                    style="border-radius: 12px;">
                                    <a href="{{ route('admin.profile') }}" class="dropdown-item rounded-2 py-2">
                                        <i class="bi bi-gear me-2 text-muted"></i> Settings
                                    </a>
                                    <hr class="dropdown-divider opacity-50">
                                    <a class="dropdown-item rounded-2 py-2 text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
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

            <main class="py-4 container">
                {{-- Flash Messages --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 mb-4 shadow-sm border-0"
                        role="alert" style="background: #ecfdf5; color: #065f46; border-radius: 12px;">
                        <i class="bi bi-check-circle-fill fs-5 me-3"></i>
                        <div class="flex-grow-1">
                            <strong>Success!</strong>
                            <span class="d-block small">{{ session('success') }}</span>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        @else
            <div class="guest-wrapper">
                @yield('content')
            </div>
        @endauth
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(() => {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    if (bsAlert) bsAlert.close();
                }, 5000);
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
