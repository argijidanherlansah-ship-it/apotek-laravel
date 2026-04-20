<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Obat
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <div class="bg-white shadow rounded-lg p-8 max-w-3xl">

            <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Obat --}}
                <div class="mb-5">
                    <label class="block text-gray-700 mb-2 font-medium">
                        Nama Obat
                    </label>
                    <input type="text"
                        name="nama_obat"
                        value="{{ old('nama_obat', $obat->nama_obat) }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                </div>

                {{-- Kategori --}}
                <div class="mb-5">
                    <label class="block text-gray-700 mb-2 font-medium">
                        Kategori
                    </label>
                    <select name="kategori_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ $obat->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Supplier --}}
                <div class="mb-5">
                    <label class="block text-gray-700 mb-2 font-medium">
                        Supplier
                    </label>
                    <select name="supplier_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                {{ $obat->supplier_id == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->nama_supplier }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Stok --}}
                <div class="mb-5">
                    <label class="block text-gray-700 mb-2 font-medium">
                        Stok
                    </label>
                    <input type="number"
                        name="stok"
                        value="{{ old('stok', $obat->stok) }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                </div>

                {{-- Harga --}}
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2 font-medium">
                        Harga
                    </label>
                    <input type="number"
                        step="0.01"
                        name="harga"
                        value="{{ old('harga', $obat->harga) }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-4 mt-8">
                    <a href="{{ route('obat.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-md transition">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>