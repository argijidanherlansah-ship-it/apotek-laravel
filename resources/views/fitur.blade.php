<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Apotek Tiga Dara</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    html { scroll-behavior: smooth; }

    /* ANIMASI */
    .fade-up {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s ease;
    }

    .fade-up.show {
        opacity: 1;
        transform: translateY(0);
    }

    /* CARD PREMIUM */
    .card {
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        transition: 0.3s;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4),
                    0 0 20px rgba(34,197,94,0.3);
    }

    /* TEXT GRADIENT */
    .gradient-text {
        background: linear-gradient(to right, #22c55e, #38bdf8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    </style>
</head>

<body class="bg-gray-100 font-sans">

<!-- NAVBAR -->
<div id="navbar" class="fixed top-0 left-0 w-full flex justify-between items-center px-6 md:px-10 py-4 z-50 text-white transition-all duration-300">
    <h1 class="text-lg md:text-xl font-bold"> Apotek Tiga Dara</h1>

    <div>
        @auth
            <a href="/dashboard" class="font-semibold">Dashboard</a>
        @else
            <a href="/login" class="mr-4">Login</a>
            <a href="/register" class="bg-white text-green-600 px-4 py-2 rounded-lg font-semibold">Register</a>
        @endauth
    </div>
</div>

<!-- HERO -->
<div class="relative h-screen flex items-center justify-center text-center text-white"
     style="background-image: url('{{ asset('images/etalase.jpg') }}'); background-size: cover; background-position:center;">

    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative z-10 fade-up px-4">
        <h2 class="text-4xl md:text-6xl font-extrabold gradient-text mb-6">
            Sistem Inventory Apotek Modern
        </h2>

        <p class="mb-6 max-w-xl mx-auto">
            Kelola stok obat otomatis dengan metode 
            <b>Safety Stock</b> & <b>Reorder Point (ROP)</b>
        </p>

        <div class="flex flex-wrap justify-center gap-3">
            <a href="/login" class="bg-green-500 px-6 py-3 rounded-lg font-semibold hover:scale-105 transition">
                 Mulai Sekarang
            </a>

            <a href="#fitur" class="border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition">
                Lihat Fitur
            </a>
        </div>
    </div>
</div>

<!-- TRUST -->
<div class="py-12 bg-white text-center fade-up">
    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto text-gray-700 font-medium">
        <div>✅ Stok lebih akurat</div>
        <div>⚡ Real-time system</div>
        <div>📉 Mengurangi kehabisan obat</div>
    </div>
</div>

<!-- FITUR -->
<div id="fitur" class="bg-gray-900 text-white py-20 px-6">
    <h2 class="text-3xl font-bold text-center mb-12 fade-up">Fitur Unggulan</h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

        <div class="card p-6 text-center fade-up">
            <div class="text-4xl mb-2">💊</div>
            <h3 class="font-bold text-lg">Manajemen Stok</h3>
            <p class="text-sm opacity-80 mt-2">
                Kelola stok obat secara real-time dan terintegrasi.
            </p>
        </div>

        <div class="card p-6 text-center fade-up">
            <div class="text-4xl mb-2">📊</div>
            <h3 class="font-bold text-lg">Analisis ROP</h3>
            <p class="text-sm opacity-80 mt-2">
                Tentukan waktu pemesanan otomatis berdasarkan data.
            </p>
        </div>

        <div class="card p-6 text-center fade-up">
            <div class="text-4xl mb-2">🧠</div>
            <h3 class="font-bold text-lg">Safety Stock</h3>
            <p class="text-sm opacity-80 mt-2">
                Hitung stok aman untuk menghindari kekosongan.
            </p>
        </div>

        <div class="card p-6 text-center fade-up">
            <div class="text-4xl mb-2">🚨</div>
            <h3 class="font-bold text-lg">Notifikasi Stok</h3>
            <p class="text-sm opacity-80 mt-2">
                Peringatan otomatis saat stok hampir habis.
            </p>
        </div>

    </div>
</div>

<!-- CARA KERJA -->
<div class="py-20 bg-white text-center fade-up">
    <h2 class="text-3xl font-bold mb-10">Cara Kerja Sistem</h2>

    <div class="grid md:grid-cols-4 gap-6 max-w-6xl mx-auto text-gray-700 font-medium">
        <div>1️⃣ Input Data Obat</div>
        <div>2️⃣ Hitung Safety Stock</div>
        <div>3️⃣ Hitung ROP</div>
        <div>4️⃣ Rekomendasi Pemesanan</div>
    </div>
</div>

<!-- PREVIEW -->
<div class="py-20 bg-gray-100 text-center fade-up">
    <h2 class="text-3xl font-bold mb-6">Preview Sistem</h2>

    <img src="{{ asset('images/preview.png') }}" 
         class="mx-auto rounded-xl shadow-lg max-w-4xl w-full">
</div>

<!-- CTA -->
<div class="py-20 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-center fade-up">
    <h2 class="text-3xl font-bold mb-4">
        Siap Mengelola Stok Lebih Cerdas?
    </h2>

    <a href="/login" class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:scale-105 transition">
        Mulai Sekarang
    </a>
</div>

<!-- FOOTER -->
<div class="text-center text-sm text-gray-500 py-6">
    © {{ date('Y') }} Apotek Tiga Dara
</div>

<!-- SCRIPT -->
<script>
const elements = document.querySelectorAll('.fade-up');

window.addEventListener('scroll', () => {
    elements.forEach(el => {
        const top = el.getBoundingClientRect().top;
        if (top < window.innerHeight - 100) {
            el.classList.add('show');
        }
    });
});
</script>

</body>
</html>