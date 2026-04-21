<x-layouts.app>

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
            <h3 class="font-bold mb-4">📊 Grafik Penggunaan Obat</h3>
            <canvas id="chartObat"></canvas>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold mb-4">📈 Grafik Bulanan</h3>
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

    <!-- TOP OBAT -->
    @if($topObat->count())
    <div class="bg-white p-6 rounded-2xl shadow-lg">

        <h3 class="font-bold text-lg mb-6">🔥 Top Obat Terlaris</h3>

        <div class="space-y-4">

            @foreach($topObat as $index => $item)

            @php
                $max = $topObat->max('total') ?: 1;
                $percent = ($item->total / $max) * 100;
            @endphp

            <div class="p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition">

                <div class="flex justify-between mb-2">
                    <span class="font-semibold">
                        {{ $item->obat->nama_obat ?? '-' }}
                    </span>
                    <span class="text-sm font-bold">
                        {{ $item->total }} unit
                    </span>
                </div>

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

new Chart(document.getElementById('chartObat'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{ data: data }]
    }
});

new Chart(document.getElementById('chartBulan'), {
    type: 'line',
    data: {
        labels: bulanLabels,
        datasets: [{ data: bulanData }]
    }
});
</script>

</x-layouts.app>