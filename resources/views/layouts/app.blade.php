<!DOCTYPE html>
<html lang="id" class="overflow-x-clip w-full max-w-[100vw]">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-landeuh.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Landeuh Village Riverside')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Flatpickr CSS for Date Range -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#F8EDD8] font-sans text-gray-800 antialiased overflow-x-clip w-full max-w-[100vw]">
    @include('components.header')
    
    <main>
        @yield('content')
    </main>
    
    @unless(trim($__env->yieldContent('hide_footer')))
    @include('components.footer')
    @endunless

    <!-- Modals -->
    @include('components.modal-login')
    @include('components.modal-register')

    <!-- Flatpickr JS & Locale -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    
    @stack('scripts')
</body>
</html>
