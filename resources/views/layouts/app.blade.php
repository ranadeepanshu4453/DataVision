<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased h-full">
        <div>
            <!-- Sidebar -->
            @include('layouts.navigation')

            <div class="lg:pl-72">
                <!-- Navigation -->
                @include('partials.header')

                <!-- Header -->
                @isset($header)
                    <header class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </header>
                @endisset
                <main class="py-10 bg-violet-10">
                    <!-- content -->
                    @yield('content')
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
