<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $setting = \App\Models\Setting::first();
    @endphp

    <!-- TITLE DINAMIS -->
    <title>
        {{ $setting->nama_apotek ?? config('app.name', 'Apotek Tiga Dara') }}
    </title>

    <!-- FAVICON DINAMIS -->
    @if($setting && $setting->logo)
        <link rel="icon" href="{{ asset('images/'.$setting->logo) }}">
    @else
        <link rel="icon" href="{{ asset('images/logo-apotek.png') }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">

        <!-- NAVBAR -->
        @include('layouts.navigation')

        <!-- HEADER -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- CONTENT -->
        <main>
            {{ $slot }}
        </main>

    </div>

</body>
</html>