<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi AMIKOM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Universitas AMIKOM Yogyakarta
            </h1>
            <p class="text-sm text-gray-600 mb-1">
                Fakultas Ilmu Komputer - Program Studi S1 Sistem Informasi
            </p>
            <p class="text-xs text-gray-500 border-t pt-2 mt-2">
                Modul Praktikum
            </p>
        </div>

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Anda"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                Login
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-gray-500">
            <p>&copy; 2026 Universitas AMIKOM Yogyakarta. All rights reserved.</p>
        </div>
    </div>

</body>
</html>