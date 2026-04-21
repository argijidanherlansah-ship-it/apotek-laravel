<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Apotek Tiga Dara</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-gray-900 text-white flex flex-col">

        <div class="p-6 text-2xl font-bold border-b border-gray-700">
            💊 Apotek
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="/dashboard" class="block px-4 py-2 rounded-lg hover:bg-gray-700">
                📊 Dashboard
            </a>

            <a href="/obat" class="block px-4 py-2 rounded-lg hover:bg-gray-700">
                💊 Data Obat
            </a>

            <a href="/supplier" class="block px-4 py-2 rounded-lg hover:bg-gray-700">
                🏢 Supplier
            </a>

            <a href="/transaksi-masuk" class="block px-4 py-2 rounded-lg hover:bg-gray-700">
                📥 Barang Masuk
            </a>

            <a href="/transaksi-keluar" class="block px-4 py-2 rounded-lg hover:bg-gray-700">
                📤 Barang Keluar
            </a>

            <a href="/laporan" class="block px-4 py-2 rounded-lg hover:bg-gray-700">
                📄 Laporan
            </a>

        </nav>

        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="/logout">
                @csrf
                <button class="w-full bg-red-500 py-2 rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>

    </div>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

        <!-- NAVBAR -->
        <div class="bg-white shadow p-4 flex justify-between items-center">

            <h1 class="text-xl font-bold">
                Dashboard
            </h1>

            <div>
                👤 {{ Auth::user()->name ?? 'User' }}
            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-6 overflow-y-auto">
            {{ $slot }}
        </div>

    </div>

</div>

</body>
</html>