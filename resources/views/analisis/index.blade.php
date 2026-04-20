<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Analisis Reorder Point (ROP)
        </h2>
    </x-slot>

    <div class="py-6 px-6">

        <!-- 🔥 PENJELASAN METODE -->
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded">
            <h5 class="font-bold mb-2">Perhitungan Metode</h5>

            <p>
                Sistem ini menggunakan metode <b>Safety Stock</b> dan <b>Reorder Point (ROP)</b> 
                untuk menentukan waktu pemesanan ulang obat secara optimal.
            </p>

            <ul class="mt-2 list-disc ml-5">
                <li>
                    <b>Safety Stock (SS)</b> = (Pemakaian Maksimum − Pemakaian Rata-rata) × Lead Time
                </li>
                <li>
                    <b>Reorder Point (ROP)</b> = (Lead Time × Pemakaian Rata-rata) + Safety Stock
                </li>
            </ul>

            <p class="mt-2 text-sm">
                *Perhitungan dilakukan secara otomatis berdasarkan histori transaksi obat keluar.
            </p>
        </div>

        <!-- 🔥 TABEL -->
        <div class="bg-white p-6 rounded-lg shadow-md">

            <table class="w-full border border-gray-200">

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

                    @foreach($obats as $obat)

                    @php
                        $rekomendasi = 0;

                        if($obat->stok <= $obat->rop){
                            $rekomendasi = $obat->rop - $obat->stok;
                        }
                    @endphp

                    <tr class="text-center border-b">

                        <td class="p-3">
                            {{ $loop->iteration }}
                        </td>

                        <td class="p-3 font-semibold">
                            {{ $obat->nama_obat }}
                        </td>

                        <td class="p-3">
                            {{ $obat->stok }}
                        </td>

                        <td class="p-3">
                            {{ $obat->safety_stock }}
                        </td>

                        <td class="p-3">
                            {{ $obat->rop }}
                        </td>

                        <td class="p-3">

                            @if($obat->stok <= $obat->rop)

                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm">
                                    Harus Pesan
                                </span>

                            @elseif($obat->stok <= $obat->safety_stock)

                                <span class="bg-yellow-400 text-black px-3 py-1 rounded-full text-sm">
                                    Stok Minimum
                                </span>

                            @else

                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                                    Aman
                                </span>

                            @endif

                        </td>

                        <td class="p-3">

                            @if($rekomendasi > 0)

                                <span class="bg-yellow-400 text-black px-3 py-1 rounded-full text-sm">
                                    Pesan {{ $rekomendasi }}
                                </span>

                            @else

                                <span class="text-gray-500">
                                    -
                                </span>

                            @endif

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>