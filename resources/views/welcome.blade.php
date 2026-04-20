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
    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(40px); }
        100% { opacity: 1; transform: translateY(0); }
    }

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
        backdrop-filter: blur(12px);
        background: rgba(255,255,255,0.1);
        border-radius: 20px;
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    /* GRADIENT TEXT */
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
    <h1 class="text-lg md:text-xl font-bold tracking-wide">
         Apotek Tiga Dara
    </h1>

    <div class="text-sm md:text-base">
        @auth
            <a href="/dashboard" class="font-semibold hover:text-green-400">Dashboard</a>
        @else
            <a href="/login" class="mr-4 hover:text-green-400">Login</a>
            <a href="/register" class="bg-white text-green-600 px-4 py-2 rounded-lg font-semibold shadow hover:scale-105 transition">
                Register
            </a>
        @endauth
    </div>
</div>

<!-- HERO -->
<div class="relative h-screen flex items-center justify-center text-center text-white"
     style="background-image: url('{{ asset('images/etalase.jpg') }}');
            background-size: cover;
            background-position: center;">

    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative z-10 px-6 fade-up">

        <h2 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight gradient-text">
            Sistem Inventory Apotek
        </h2>

        <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto opacity-90">
            Menggunakan metode <b>Safety Stock</b> & <b>Reorder Point (ROP)</b>  
            untuk pengelolaan stok obat yang lebih akurat dan efisien.
        </p>

        <div class="flex flex-wrap justify-center gap-3">
            <a href="/login" 
               class="bg-green-500 px-6 py-3 rounded-lg shadow font-semibold hover:scale-105 transition">
                  Masuk
            </a>

            <a href="#fitur" 
               class="border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition">
                Lihat Fitur ↓
            </a>
        </div>

    </div>
</div>

<!-- FITUR -->
<div id="fitur" class="bg-gradient-to-br from-gray-900 to-gray-800 text-white py-20 px-6 md:px-10">

    <div class="text-center mb-12 fade-up">
        <h2 class="text-3xl md:text-4xl font-bold mb-2">
            Fitur Unggulan
        </h2>
        <p class="opacity-70">Sistem modern untuk manajemen apotek</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        <!-- CARD 1 -->
        <div class="card p-8 text-center fade-up">
            <div class="text-4xl mb-4">💊</div>
            <h3 class="font-bold text-xl mb-2">Manajemen Stok</h3>
            <p class="opacity-70">
                Mengelola data obat dan stok secara real-time dengan sistem terintegrasi.
            </p>
        </div>

        <!-- CARD 2 -->
        <div class="card p-8 text-center fade-up">
            <div class="text-4xl mb-4">📊</div>
            <h3 class="font-bold text-xl mb-2">Analisis ROP</h3>
            <p class="opacity-70">
                Menentukan kapan harus melakukan pemesanan ulang secara otomatis.
            </p>
        </div>

        <!-- CARD 3 -->
        <div class="card p-8 text-center fade-up">
            <div class="text-4xl mb-4">🧠</div>
            <h3 class="font-bold text-xl mb-2">Safety Stock</h3>
            <p class="opacity-70">
                Menentukan stok minimum untuk menghindari kehabisan barang saat permintaan tinggi.
            </p>
        </div>

        <!-- CARD 4 -->
        <div class="card p-8 text-center fade-up">
            <div class="text-4xl mb-4">🚨</div>
            <h3 class="font-bold text-xl mb-2">Notifikasi Stok</h3>
            <p class="opacity-70">
                Memberikan peringatan ketika stok obat mendekati batas minimum.
            </p>
        </div>

    </div>

</div>

<!-- FOOTER -->
<div class="text-center text-sm text-gray-500 py-6">
    © {{ date('Y') }} Apotek Tiga Dara - Sistem Inventory
</div>

<!-- SCRIPT -->
<script>
// navbar scroll
window.addEventListener("scroll", function () {
    let navbar = document.getElementById("navbar");

    if (window.scrollY > 50) {
        navbar.classList.add("bg-white/80", "backdrop-blur", "shadow-lg");
        navbar.classList.remove("text-white");
        navbar.classList.add("text-gray-800");
    } else {
        navbar.classList.remove("bg-white/80", "backdrop-blur", "shadow-lg");
        navbar.classList.remove("text-gray-800");
        navbar.classList.add("text-white");
    }
});

// animasi muncul saat scroll
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