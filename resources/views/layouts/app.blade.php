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

       
        @filamentStyles
        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        @livewire('navigation-menu')
        {{-- <x-banner />

        <div class="min-h-screen bg-gray-100">
          

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

     
            <main>
               
            </main>
        </div> --}}

        {{ $slot }}

                @livewireScripts
            @livewire('notifications')
            @filamentScripts
            @vite('resources/js/app.js')
    </body>
</html>
