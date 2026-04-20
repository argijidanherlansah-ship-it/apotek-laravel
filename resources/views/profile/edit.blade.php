<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Profile
    </h2>
</x-slot>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-slate-800 to-gray-900 p-6">

    <div class="w-full max-w-xl backdrop-blur-xl bg-white/10 border border-white/20 shadow-2xl rounded-3xl p-8 text-white transition">

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="formProfile">
            @csrf
            @method('patch')

            @php
                $foto = auth()->user()->foto 
                    ? asset('storage/foto/' . auth()->user()->foto) 
                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name);
            @endphp

            <!-- FOTO -->
            <div class="mb-6 text-center">

                <div id="dropArea" class="relative inline-block cursor-pointer">

                    <img id="previewImage" src="{{ $foto }}" 
                        class="w-28 h-28 rounded-full mx-auto mb-3 shadow-xl border-4 border-white/40 object-cover transition duration-300 hover:scale-110 hover:shadow-green-400/50">

                    <!-- Badge -->
                    <span class="absolute bottom-2 right-2 bg-green-500 w-4 h-4 rounded-full border-2 border-white animate-pulse"></span>

                    <input type="file" name="foto" id="fotoInput" hidden>

                </div>

                <p class="text-xs text-gray-300 mt-2">Klik atau drag foto ke sini</p>

            </div>

            <!-- NAMA -->
            <div class="mb-4">
                <label class="block text-sm mb-1 text-gray-200">Nama</label>
                <input type="text" name="name" 
                    value="{{ old('name', auth()->user()->name) }}" 
                    class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/20 focus:ring-2 focus:ring-green-400 focus:outline-none text-white transition">
            </div>

            <!-- EMAIL -->
            <div class="mb-6">
                <label class="block text-sm mb-1 text-gray-200">Email</label>
                <input type="email" name="email" 
                    value="{{ old('email', auth()->user()->email) }}" 
                    class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/20 focus:ring-2 focus:ring-green-400 focus:outline-none text-white transition">
            </div>

            <!-- BUTTON -->
            <button id="btnSubmit"
                class="w-full bg-gradient-to-r from-green-500 to-emerald-600 py-2 rounded-lg font-semibold shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300 flex items-center justify-center gap-2">

                <span id="btnText"> Update Profile</span>

                <!-- LOADING -->
                <svg id="loadingIcon" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"></circle>
                    <path class="opacity-75" fill="white"
                        d="M4 12a8 8 0 018-8v8z"></path>
                </svg>

            </button>

        </form>

    </div>

</div>

<!-- SCRIPT -->
<script>

// ================= PREVIEW FOTO =================
document.getElementById('fotoInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(file){
        document.getElementById('previewImage').src = URL.createObjectURL(file);
    }
});

// ================= CLICK FOTO =================
document.getElementById('dropArea').addEventListener('click', function(){
    document.getElementById('fotoInput').click();
});

// ================= DRAG DROP =================
const dropArea = document.getElementById('dropArea');

dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('scale-110');
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('scale-110');
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('scale-110');

    const file = e.dataTransfer.files[0];
    document.getElementById('fotoInput').files = e.dataTransfer.files;

    document.getElementById('previewImage').src = URL.createObjectURL(file);
});

// ================= BUTTON LOADING =================
document.getElementById('formProfile').addEventListener('submit', function(){
    document.getElementById('btnText').innerText = "Menyimpan...";
    document.getElementById('loadingIcon').classList.remove('hidden');
});

</script>

</x-app-layout>