<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Analisis Safety Stock dan Reorder Point (ROP)
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow">

            <!-- 🔥 PENJELASAN METODE -->
            <div class="mb-6 p-4 bg-blue-100 border-l-4 border-blue-500 rounded">
                <h3 class="font-bold text-blue-700 mb-2">Perhitungan Metode</h3>

                <p class="text-sm text-gray-700 mb-2">
                    Sistem ini menggunakan metode <b>Safety Stock</b> dan 
                    <b>Reorder Point (ROP)</b> untuk menentukan kapan harus melakukan pemesanan ulang obat.
                </p>

                <ul class="text-sm text-gray-800 list-disc ml-5">
                    <li>
                        <b>Safety Stock (SS)</b> = (Pemakaian Maksimum − Pemakaian Rata-rata) × Lead Time
                    </li>
                    <li>
                        <b>Reorder Point (ROP)</b> = (Lead Time × Pemakaian Rata-rata) + Safety Stock
                    </li>
                    <li>
                        <b>Lead Time</b> = Waktu tunggu pemesanan (default: 2 hari)
                    </li>
                </ul>

                <p class="text-xs text-gray-600 mt-2">
                    *Perhitungan dilakukan otomatis berdasarkan data transaksi obat keluar.
                </p>
            </div>

            <!-- 🔥 TABEL -->
            <div class="overflow-x-auto">
                <table class="w-full border text-center rounded overflow-hidden">
                    
                    <thead class="bg-purple-600 text-white">
                        <tr>
                            <th class="p-3">No</th>
                            <th class="p-3">Nama Obat</th>
                            <th class="p-3">Stok</th>
                            <th class="p-3">Safety Stock</th>
                            <th class="p-3">ROP</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Rekomendasi Pesan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($obats as $index => $item)
                            <tr class="border-b hover:bg-gray-50 transition">

                                <td class="p-2">{{ $index+1 }}</td>
                                <td class="p-2">{{ $item->nama_obat }}</td>
                                <td class="p-2">{{ $item->stok }}</td>
                                <td class="p-2">{{ $item->safety_stock }}</td>
                                <td class="p-2">{{ $item->rop }}</td>

                                <!-- STATUS -->
                                <td class="p-2">
                                    @if($item->status == 'Harus Pesan')
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                            Harus Pesan
                                        </span>
                                    @else
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                            Aman
                                        </span>
                                    @endif
                                </td>

                                <!-- 🔥 REKOMENDASI -->
                                <td class="p-2">
                                    @if($item->status == 'Harus Pesan')
                                        <span class="text-red-600 font-bold">
                                            Pesan {{ $item->rekomendasi ?? 0 }} pcs
                                        </span>
                                    @else
                                        <span class="text-gray-400 italic">-</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</x-app-layout>