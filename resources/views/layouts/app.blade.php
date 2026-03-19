<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Solar Expert</title>
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%232563eb%22><path d=%22M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z%22/></svg>">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" />

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
        }

        /* Modern Navbar Styling */
        .navbar {
            /* padding: 1rem 0; */
            background-color: #FDFDFC !important;
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
            /* Blue-600 */
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .nav-link {
            font-weight: 500;
            color: #1b1b18 !important;
            padding: 0.5rem 1rem !important;
            transition: all 0.2s;
        }

        .nav-link:hover {
            opacity: 0.7;
        }

        /* Register Button Accent */
        .btn-auth-accent {
            background-color: #2563eb;
            color: white !important;
            border-radius: 6px;
            padding: 6px 20px !important;
            font-weight: 600;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn-auth-accent:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }

        /* Dropdown Styling */
        .dropdown-menu {
            border: 1px solid #19140015;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-none">
            <div class="container">
                <a class="navbar-brand" href="{{ Auth::check() ? route('dashboard') : url('/') }}">
                    <div class="brand-icon">
                        <i class="bi bi-file-earmark-arrow-up-fill" style="font-size: 1.1rem;"></i>
                    </div>
                    <span>My Solar Expert</span>
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('documents.create') }}">
                                    <i class="bi bi-plus-lg me-1"></i> {{ __('Upload document') }}
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Log in') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item ms-md-2">
                                    <a class="nav-link btn-auth-accent"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                    class="nav-link dropdown-toggle fw-bold d-flex align-items-center gap-2" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>

                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center overflow-hidden"
                                        style="width: 32px; height: 32px; border: 1px solid #eef2ff;">
                                        @if (Auth::user()->profile?->profile_picture)
                                            <img src="{{ asset('storage/' . Auth::user()->profile->profile_picture) }}"
                                                alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="bi bi-person-circle text-primary"></i>
                                        @endif
                                    </div>

                                    <span>{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('users.profile') }}" class="dropdown-item rounded-2">
                                        <i class="bi bi-person me-2"></i> Profile
                                    </a>
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item rounded-2 text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4"
                    role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4"
                    role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <main class="py-0">
            @yield('content')
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @stack('scripts')
</body>

</html>
