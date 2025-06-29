<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Meta Tags -->
    <meta name="description" content="@yield('description', 'Laravel Application')">
    <meta name="keywords" content="@yield('keywords', 'laravel, web, application')">
    <meta name="author" content="@yield('author', 'Laravel Team')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og:title', config('app.name'))">
    <meta property="og:description" content="@yield('og:description', 'Laravel Application')">
    <meta property="og:image" content="@yield('og:image', asset('images/og-image.jpg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter:title', config('app.name'))">
    <meta property="twitter:description" content="@yield('twitter:description', 'Laravel Application')">
    <meta property="twitter:image" content="@yield('twitter:image', asset('images/og-image.jpg'))">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50 font-sans antialiased">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium z-50">
        Skip to main content
    </a>

    <div id="app" class="min-h-screen flex flex-col">
        <!-- Header/Navigation -->
        @hasSection('header')
            <header class="bg-white shadow-sm border-b border-gray-200">
                @yield('header')
            </header>
        @else
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-900 hover:text-gray-700 transition duration-150 ease-in-out">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>
                        <div class="md:hidden">
                            <button type="button" class="text-gray-600 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out" x-data="{ open: false }" @click="open = !open">
                                <span class="sr-only">Open main menu</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </header>
        @endif

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md mx-4 mt-4" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md mx-4 mt-4" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('warning'))
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-md mx-4 mt-4" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('warning') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-md mx-4 mt-4" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('info') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main id="main-content" class="flex-1 @yield('main-class', 'py-8')">
            @hasSection('breadcrumbs')
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-4">
                            @yield('breadcrumbs')
                        </ol>
                    </nav>
                </div>
            @endif

            @hasSection('page-header')
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
                    @yield('page-header')
                </div>
            @endif

            <div class="@yield('content-wrapper', 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8')">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        @hasSection('footer')
            <footer class="bg-white border-t border-gray-200 mt-auto">
                @yield('footer')
            </footer>
        @else
            <footer class="bg-white border-t border-gray-200 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="text-sm text-gray-600 mb-4 md:mb-0">
                            © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                        </div>
                        <div class="flex space-x-6">
                            <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition duration-150 ease-in-out">
                                Privacy Policy
                            </a>
                            <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition duration-150 ease-in-out">
                                Terms of Service
                            </a>
                            <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition duration-150 ease-in-out">
                                Contact
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        @endif
    </div>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @stack('scripts')

    <!-- Alpine.js for interactive components (optional) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>