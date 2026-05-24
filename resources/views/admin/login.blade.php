<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Landeuh Village</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-4 text-center">Login Admin</h2>
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700" for="email">Email</label>
                <input class="w-full border rounded px-3 py-2" type="email" name="email" id="email" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700" for="password">Password</label>
                <input class="w-full border rounded px-3 py-2" type="password" name="password" id="password" required>
            </div>
            @if(session('error'))
                <div class="mb-4 text-red-600">{{ session('error') }}</div>
            @endif
            <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700" type="submit">Login</button>
        </form>
    </div>
</body>
</html>
