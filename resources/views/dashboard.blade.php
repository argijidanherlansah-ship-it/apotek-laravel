<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
    </h2>
</x-slot>

<div class="p-6 space-y-6">

    <!-- WELCOME -->
    <div class="bg-gradient-to-r from-sky-500 to-emerald-500 text-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}</h1>
        <p class="text-sm opacity-90">Sistem Inventory Apotek</p>
    </div>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition hover:scale-[1.02]">
            <p class="text-sm text-gray-500">Total Obat</p>
            <h2 class="text-2xl font-bold text-sky-600">{{ $totalObat }}</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition hover:scale-[1.02]">
            <p class="text-sm text-gray-500">Supplier</p>
            <h2 class="text-2xl font-bold text-emerald-600">{{ $totalSupplier }}</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition hover:scale-[1.02]">
            <p class="text-sm text-gray-500">Obat Masuk</p>
            <h2 class="text-2xl font-bold text-blue-600">{{ $totalMasuk }}</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition hover:scale-[1.02]">
            <p class="text-sm text-gray-500">Obat Keluar</p>
            <h2 class="text-2xl font-bold text-red-500">{{ $totalKeluar }}</h2>
        </div>

    </div>

    <!-- GRAFIK -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold mb-4"> Grafik Penggunaan Obat</h3>
            <canvas id="chartObat"></canvas>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold mb-4"> Grafik Bulanan</h3>
            <canvas id="chartBulan"></canvas>
        </div>

    </div>

    <!-- INSIGHT -->
    @if($insight)
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-xl shadow-sm">
        <p class="font-semibold text-blue-700">Insight Sistem</p>
        <p class="text-sm text-blue-600">{{ $insight }}</p>
    </div>
    @endif

    <!-- WARNING -->
    @if($totalHarusPesan > 0)
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm">
        <p class="font-semibold text-red-700">Peringatan</p>
        <p class="text-sm text-red-600">
            {{ $totalHarusPesan }} obat harus segera dipesan
        </p>
    </div>
    @endif

    <!-- TOP OBAT PREMIUM -->
    @if($topObat->count())
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h3 class="font-bold text-lg mb-6 flex items-center gap-2">
             Top Obat Terlaris
        </h3>

        <div class="space-y-4">

            @foreach($topObat as $index => $item)

            @php
                $max = $topObat->max('total') ?: 1;
                $percent = ($item->total / $max) * 100;
            @endphp

            <div class="p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition hover:scale-[1.01]">

                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center gap-3">

                        <!-- RANK -->
                        <div class="
                            w-8 h-8 flex items-center justify-center rounded-full text-white text-sm font-bold
                            {{ $index == 0 ? 'bg-yellow-400' : ($index == 1 ? 'bg-gray-400' : ($index == 2 ? 'bg-orange-400' : 'bg-blue-400')) }}
                        ">
                            {{ $index + 1 }}
                        </div>

                        <!-- NAMA -->
                        <span class="font-semibold text-gray-700">
                            {{ $item->obat->nama_obat ?? '-' }}
                        </span>
                    </div>

                    <!-- TOTAL -->
                    <span class="text-sm font-bold text-gray-600">
                        {{ $item->total }} unit
                    </span>
                </div>

                <!-- PROGRESS -->
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-sky-500 to-emerald-500 h-2 rounded-full"
                         style="width: {{ $percent }}%">
                    </div>
                </div>

            </div>

            @endforeach

        </div>

    </div>
    @endif

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = @json($labels);
const data = @json($data);

const bulanLabels = @json($bulanLabels);
const bulanData = @json($bulanData);

// BAR CHART
new Chart(document.getElementById('chartObat'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Penggunaan Obat',
            data: data,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } }
    }
});

// LINE CHART
new Chart(document.getElementById('chartBulan'), {
    type: 'line',
    data: {
        labels: bulanLabels,
        datasets: [{
            label: 'Total Keluar',
            data: bulanData,
            tension: 0.4,
            fill: true
        }]
    },
    options: { responsive: true }
});
</script>

</x-app-layout>