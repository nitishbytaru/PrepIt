<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.website_logo') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-md animate-fade-in">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="py-8">
            <div class="animate-scale-in">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-indigo-800 to-purple-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="space-y-4 animate-slide-in">
                    <h3 class="text-xl font-bold">PrepIt</h3>
                    <p class="text-indigo-200">Your personalized learning journey starts here. Track progress, set
                        goals, and achieve more.</p>
                </div>
                <div class="space-y-4 animate-slide-in animate-delay-100">
                    <h3 class="text-xl font-bold">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('dashboard') }}"
                                class="text-indigo-200 hover:text-white transition">Dashboard</a></li>
                        <li><a href="{{ route('timeslots.index') }}"
                                class="text-indigo-200 hover:text-white transition">Timeslots</a></li>
                        <li><a href="{{ route('goals.index') }}"
                                class="text-indigo-200 hover:text-white transition">Goals</a></li>
                        <li><a href="{{ route('tasks.index') }}"
                                class="text-indigo-200 hover:text-white transition">Tasks</a></li>
                    </ul>
                </div>
                <div class="space-y-4 animate-slide-in animate-delay-200">
                    <h3 class="text-xl font-bold">Contact Us</h3>
                    <p class="text-indigo-200">Have questions? We're here to help with your educational journey.</p>
                    <p class="text-indigo-200">Email: support@prepit.edu</p>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-indigo-700 text-center text-indigo-200">
                <p>&copy; {{ date('Y') }} PrepIt. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
