<!DOCTYPE html>
<html lang='en'>
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-landeuh.png') }}">
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Login')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'], str_contains(public_path(), 'public_html') ? '' : 'build')
</head>
<body>
    @yield('content')
</body>
</html>
