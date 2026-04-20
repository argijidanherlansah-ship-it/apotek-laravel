<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Transaksi Masuk
        </h2>
    </x-slot>

    <div class="py-6 px-6">

        <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl">

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('transaksi-masuk.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Obat</label>
                    <select name="obat_id"
                        class="w-full border rounded-md px-3 py-2"
                        required>
                        <option value="">-- Pilih Obat --</option>
                        @foreach($obats as $obat)
                            <option value="{{ $obat->id }}">
                                {{ $obat->nama_obat }} (Stok: {{ $obat->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Jumlah Masuk</label>
                    <input type="number" name="jumlah"
                        class="w-full border rounded-md px-3 py-2"
                        required>
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-medium">Tanggal</label>
                    <input type="date" name="tanggal"
                        class="w-full border rounded-md px-3 py-2"
                        required>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('transaksi-masuk.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                        Batal
                    </a>

                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md">
                        Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>
</x-app-layout>