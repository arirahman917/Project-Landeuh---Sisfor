<!DOCTYPE html>
<html lang="id" class="overflow-x-clip w-full">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-landeuh.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Landeuh Village Riverside - Penginapan dan Wisata Alam Terbaik di Tepian Sungai dengan Suasana Asri dan Fasilitas Lengkap.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Landeuh Village Riverside')</title>

    <!-- Resource Hints & Font with display=swap -->
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- LCP Hero Image Preload for Instant Discovery -->
    @if(request()->is('/'))
    <link rel="preload" as="image" href="{{ asset('images/akomodasi/carousel/a.webp') }}" fetchpriority="high">
    @endif

    <!-- Non-blocking Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"></noscript>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'], str_contains(public_path(), 'public_html') ? '' : 'build')
    @stack('styles')
</head>
<body class="bg-[#F8EDD8] font-sans text-gray-800 antialiased overflow-x-clip w-full min-h-screen flex flex-col">
    @include('components.header')
    
    <main class="flex-1">
        @yield('content')
    </main>
    
    @unless(trim($__env->yieldContent('hide_footer')))
    @include('components.footer')
    @endunless

    <!-- Global Modals -->
    @include('components.modal-login')
    @include('components.modal-register')

    <!-- Deferred Flatpickr JS & Locale -->
    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script defer src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    
    @stack('scripts')
</body>
</html>
