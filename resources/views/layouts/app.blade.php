<!DOCTYPE html>
<html lang="id" class="overflow-x-clip w-full">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-landeuh.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Landeuh Village Riverside - Glamping & Villa Tepi Sungai di Bogor')</title>
    <meta name="description" content="@yield('meta_description', 'Nikmati glamping tepi sungai di Bogor dengan kabin industrial asri. Tempat liburan keluarga, api unggun, & paket gathering kantor. Cek jadwal & reservasi online sekarang!')">
    <meta name="keywords" content="@yield('meta_keywords', 'glamping bogor, glamping tepi sungai, landeuh village riverside, villa tepi sungai bogor, cabin bogor, penginapan tepi sungai bogor, glamping keluarga bogor, paket gathering kantor bogor')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">
    <meta name="author" content="Landeuh Village Riverside">

    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <!-- Geo Tags for Local SEO Bogor -->
    <meta name="geo.region" content="ID-JB">
    <meta name="geo.placename" content="Babakan Madang, Kabupaten Bogor">
    <meta name="geo.position" content="-6.587150;106.927528">
    <meta name="ICBM" content="-6.587150, 106.927528">

    <!-- Open Graph (WhatsApp, Facebook, Social Media Sharing) -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', View::yieldContent('title', 'Landeuh Village Riverside - Glamping & Villa Tepi Sungai di Bogor'))">
    <meta property="og:description" content="@yield('og_description', View::yieldContent('meta_description', 'Nikmati glamping tepi sungai di Bogor dengan kabin industrial asri. Cocok untuk liburan keluarga & acara gathering.'))">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    <meta property="og:site_name" content="Landeuh Village Riverside">
    <meta property="og:image" content="@yield('og_image', asset('images/akomodasi/carousel/a.webp'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Landeuh Village Riverside Glamping Tepi Sungai Bogor">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', View::yieldContent('title', 'Landeuh Village Riverside - Glamping & Villa Tepi Sungai di Bogor'))">
    <meta name="twitter:description" content="@yield('og_description', View::yieldContent('meta_description', 'Nikmati glamping tepi sungai di Bogor dengan kabin industrial asri. Cocok untuk liburan keluarga & acara gathering.'))">
    <meta name="twitter:image" content="@yield('og_image', asset('images/akomodasi/carousel/a.webp'))">

    <!-- Schema.org JSON-LD Structured Data for LodgingBusiness -->
    <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'LodgingBusiness',
      '@id' => 'https://landeuhvillage.com/#lodging',
      'name' => 'Landeuh Village Riverside',
      'alternateName' => ['Landeuh Village', 'Landeuh Riverside Glamping'],
      'description' => 'Penginapan glamping tepi sungai, kabin kayu alami, dan villa industrial asri di Babakan Madang, Kabupaten Bogor.',
      'url' => 'https://landeuhvillage.com',
      'telephone' => '+6282114640277',
      'email' => 'landeuhvillage@gmail.com',
      'image' => [
        asset('images/akomodasi/carousel/a.webp'),
        asset('images/akomodasi/glamping_vip/c.webp'),
        asset('images/akomodasi/cabin5/a.webp'),
      ],
      'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Kp. Wangun Landeuh, Karang Tengah',
        'addressLocality' => 'Babakan Madang',
        'addressRegion' => 'Jawa Barat',
        'postalCode' => '16810',
        'addressCountry' => 'ID',
      ],
      'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => -6.587150,
        'longitude' => 106.927528,
      ],
      'hasMap' => 'https://maps.google.com/?cid=11001886129881104457',
      'priceRange' => 'Rp 350.000 - Rp 2.500.000',
      'amenityFeature' => [
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Aliran Sungai Alami', 'value' => true],
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Area Api Unggun', 'value' => true],
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Fasilitas BBQ', 'value' => true],
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Kedai Makan & Kopi', 'value' => true],
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Area Bermain Anak', 'value' => true],
        ['@type' => 'LocationFeatureSpecification', 'name' => 'Parkir Gratis', 'value' => true],
      ],
      'checkinTime' => '14:00',
      'checkoutTime' => '12:00',
      'sameAs' => [
        'https://instagram.com/landeuhvillageriverside',
        'https://tiktok.com/@landeuh',
      ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @stack('schema')

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
<body class="bg-[#F8EDD8] font-sans text-gray-800 antialiased overflow-x-clip w-full min-h-screen flex flex-col">@include('components.header')
    
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
