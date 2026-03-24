<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Solar Expert</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%232563eb%22><path d=%22M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z%22/></svg>">
    <link rel="preconnect" href="https://fonts.bunny.net">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.bunny.net/css?family=instrument-sans:400,500,600');

        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>

{{-- <body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">My Solar Expert</a>
                    </li>
                </ul>
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">

    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body> --}}

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <header class="w-full lg:max-w-6xl max-w-[335px] text-sm mb-6">
        @if (Route::has('login'))
            <nav class="flex items-center justify-between w-full">
                <div class="flex items-center gap-2">
                    <div class="bg-primary w-8 h-8 rounded-lg flex items-center justify-center bg-blue-600">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight dark:text-white">My Solar Expert</span>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] rounded-sm text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] rounded-sm text-sm">Log
                            in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-5 py-1.5 bg-blue-600 text-white hover:bg-blue-700 rounded-sm text-sm font-medium transition shadow-sm">Get
                                Started</a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif
    </header>

    <main class="flex flex-col items-center justify-center w-full max-w-4xl text-center py-12 lg:grow">
        <div class="space-y-6">
            <h1 class="text-4xl lg:text-6xl font-bold tracking-tight text-[#1b1b18] dark:text-white">
                Solar Project Management <br />
                <span class="text-blue-600">Made Simple.</span>
            </h1>

            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Securely upload, manage, and verify your solar installation documents. Our expert platform ensures your
                paperwork is compliant and ready for approval.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                <a href="{{ route('register') }}"
                    class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg">
                    Upload Your First Document
                </a>
                <a href="#how-it-works"
                    class="px-8 py-3 bg-white border border-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                    Learn More
                </a>
            </div>
        </div>

        <div id="how-it-works" class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20 w-full text-left">
            <div class="p-6 bg-white dark:bg-[#111] rounded-xl border border-gray-100 dark:border-[#222] shadow-sm">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-4">
                    <span class="font-bold">1</span>
                </div>
                <h3 class="font-bold mb-2 dark:text-white">Secure Upload</h3>
                <p class="text-sm text-gray-500">Drag and drop your engineering plans and permits safely to our cloud.
                </p>
            </div>

            <div class="p-6 bg-white dark:bg-[#111] rounded-xl border border-gray-100 dark:border-[#222] shadow-sm">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-4">
                    <span class="font-bold">2</span>
                </div>
                <h3 class="font-bold mb-2 dark:text-white">Expert Review</h3>
                <p class="text-sm text-gray-500">Our specialists verify each document to ensure it meets solar industry
                    standards.</p>
            </div>

            <div class="p-6 bg-white dark:bg-[#111] rounded-xl border border-gray-100 dark:border-[#222] shadow-sm">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-4">
                    <span class="font-bold">3</span>
                </div>
                <h3 class="font-bold mb-2 dark:text-white">Fast Approval</h3>
                <p class="text-sm text-gray-500">Get your projects moving faster with organized and ready-to-submit
                    files.</p>
            </div>
        </div>
    </main>

    <footer class="w-full text-center py-8 border-t border-gray-100 dark:border-[#1a1a1a] mt-12 text-gray-400 text-xs">
        &copy; {{ date('Y') }} My Solar Expert. All rights reserved.
    </footer>

</body>

</html>
