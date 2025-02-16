<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="{{asset('js/time.js')}}"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @routes
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
           @include('layouts.dashboad-navbar')
           @include('layouts.dashboard-sidebar')


            <!-- Page Content -->
            <main>
                <div class="p-4 sm:ml-64 m-14 mr-0">
                    @if(session('success'))
                    <div class="flex justify-end absolute top-20 right-0 p-3">
                        <x-toast :message="session('success')" />
                    </div>
                    @endif
                    {{ $slot }}
                </div>
            </main>
            <div class="clockStyle fixed left-1 bottom-1 font-bold" id="clock"></div>
        </div>
    </body>
</html>

