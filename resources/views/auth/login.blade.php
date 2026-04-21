<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Apotek Tiga Dara</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FIX: Pakai CDN Tailwind (bukan Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
    /* VIDEO BACKGROUND */
    #bg-video {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -2;
        animation: zoomVideo 20s ease infinite alternate;
    }

    @keyframes zoomVideo {
        from { transform: scale(1); }
        to { transform: scale(1.1); }
    }

    @media (max-width: 768px) {
        #bg-video {
            transform: scale(1.2);
        }
    }

    /* OVERLAY */
    .overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(5px);
        z-index: -1;
    }

    /* CARD */
    .glass {
        position: relative;
        z-index: 10;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }

    /* INPUT */
    .input-style {
        background: rgba(255,255,255,0.2);
        border: none;
        outline: none;
    }

    .input-style:focus {
        box-shadow: 0 0 0 2px rgba(255,255,255,0.7);
    }

    /* ANIMASI */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px);}
        to { opacity: 1; transform: translateY(0);}
    }

    .animate {
        animation: fadeIn 1s ease;
    }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">

<!-- VIDEO -->
<video autoplay muted loop playsinline id="bg-video">
    <source src="{{ asset('video/bg.mp4') }}" type="video/mp4">
</video>

<!-- OVERLAY -->
<div class="overlay"></div>

<!-- ERROR MESSAGE -->
@if ($errors->any())
    <div class="absolute top-5 bg-red-500 text-white px-4 py-2 rounded shadow">
        {{ $errors->first() }}
    </div>
@endif

<!-- CARD LOGIN -->
<div class="glass p-6 md:p-8 w-full max-w-sm md:max-w-md animate text-white text-center">

    <!-- LOGO -->
    <div class="mb-4">
        <div class="w-24 h-24 mx-auto rounded-full overflow-hidden border-2 border-white shadow-lg">
            <img src="{{ asset('images/logo.png') }}" class="w-full h-full object-contain">
        </div>
    </div>

    <!-- TITLE -->
    <h2 class="text-2xl font-bold mb-1">
        Apotek Tiga Dara
    </h2>
    <p class="text-sm mb-6 opacity-80">Inventory Management System</p>

    <!-- FORM -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- EMAIL -->
        <div class="mb-4 text-left">
            <label>Email</label>
            <input type="email" name="email" required
                class="w-full mt-1 px-4 py-2 rounded-lg input-style text-white placeholder-gray-200">
        </div>

        <!-- PASSWORD -->
        <div class="mb-6 text-left relative">
            <label>Password</label>
            <input id="password" type="password" name="password" required
                class="w-full mt-1 px-4 py-2 rounded-lg input-style text-white placeholder-gray-200">

            <span onclick="togglePassword()" 
                  class="absolute right-3 top-9 cursor-pointer">
                👁️
            </span>
        </div>

        <!-- BUTTON -->
        <button type="submit"
            class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-2 rounded-lg font-semibold shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300">
              Login
        </button>
    </form>

    <!-- REGISTER -->
    <p class="text-sm mt-4">
        Belum punya akun?
        <a href="/register" class="underline hover:text-gray-200">Register</a>
    </p>

</div>

<!-- SCRIPT -->
<script>
function togglePassword() {
    const pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>

</body>
</html>