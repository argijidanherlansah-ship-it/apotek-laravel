<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Setting Apotek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    body {
        background: linear-gradient(135deg, #0ea5e9, #10b981);
    }

    .card {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">

<div class="card p-8 w-full max-w-md text-white">

    <h2 class="text-2xl font-bold mb-6 text-center">
        ⚙️ Setting Apotek
    </h2>

    <form action="/setting/update" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label>Nama Apotek</label>
            <input type="text" name="nama_apotek"
                value="{{ $setting->nama_apotek ?? '' }}"
                class="w-full mt-1 px-4 py-2 rounded-lg bg-white/20 text-white">
        </div>

        <!-- Logo -->
        <div class="mb-4">
            <label>Upload Logo</label>
            <input type="file" name="logo"
                class="w-full mt-1">
        </div>

        <!-- Button -->
        <button class="w-full bg-gradient-to-r from-green-500 to-emerald-600 py-2 rounded-lg font-semibold hover:scale-105 transition">
            💾 Simpan
        </button>
    </form>

    <!-- Preview -->
    @if(isset($setting) && $setting->logo)
    <div class="mt-6 text-center">
        <p class="mb-2">Preview Logo:</p>
        <img src="{{ asset('images/'.$setting->logo) }}"
             class="w-20 h-20 mx-auto rounded-full object-cover border">
    </div>
    @endif

</div>

</body>
</html>