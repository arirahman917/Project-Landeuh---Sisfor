<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-landeuh.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Reservasi Penginapan & Kegiatan Landeuh Village Riverside.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Reservasi - Landeuh Village Riverside')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#F8EDD8] font-sans text-gray-800 antialiased overflow-x-hidden w-full min-h-screen">
    <main>
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>
