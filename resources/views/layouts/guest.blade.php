<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.website_logo', 'PrepIt') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-indigo-100 via-purple-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="absolute inset-0 bg-cover bg-center opacity-10"
            style="background-image: url('https://images.unsplash.com/photo-1513258496099-48168024aec0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');">
        </div>

        <div class="relative w-full max-w-md space-y-8">
            <div class="flex flex-col items-center animate-float">
                <a href="/" class="block">
                    <x-application-logo class="w-24 h-24 text-indigo-600" />
                </a>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gradient">
                    PrepIt Education
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Your journey to educational excellence starts here
                </p>
            </div>

            <div
                class="mt-8 bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in card-hover backdrop-blur-sm border border-indigo-100">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center animate-fade-in animate-delay-200">
                <p class="text-sm text-gray-600">
                    &copy; {{ date('Y') }} PrepIt Education. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
