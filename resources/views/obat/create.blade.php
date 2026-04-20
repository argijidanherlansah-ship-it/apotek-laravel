<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Obat
        </h2>
    </x-slot>

    <div class="py-6 px-6">

        <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl">

            {{-- ERROR VALIDATION --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('obat.store') }}" method="POST">
                @csrf

                {{-- NAMA OBAT --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Nama Obat</label>
                    <input type="text" name="nama_obat"
                        value="{{ old('nama_obat') }}"
                        class="w-full border rounded-md px-3 py-2"
                        required>
                </div>

                {{-- KATEGORI --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Kategori</label>
                    <select name="kategori_id"
                        class="w-full border rounded-md px-3 py-2"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SUPPLIER --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Supplier</label>
                    <select name="supplier_id"
                        class="w-full border rounded-md px-3 py-2"
                        required>
                        <option value="">-- Pilih Supplier --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->nama_supplier }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- STOK --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Stok</label>
                    <input type="number" name="stok"
                        value="{{ old('stok') }}"
                        class="w-full border rounded-md px-3 py-2"
                        required>
                </div>

                {{-- HARGA --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Harga</label>
                    <input type="number" name="harga"
                        value="{{ old('harga') }}"
                        class="w-full border rounded-md px-3 py-2"
                        required>
                </div>

                {{-- LEAD TIME --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Lead Time (Hari)</label>
                    <input type="number" name="lead_time"
                        value="{{ old('lead_time') }}"
                        class="w-full border rounded-md px-3 py-2"
                        required>
                </div>

                {{-- PEMAKAIAN RATA --}}
<div class="mb-4">
    <label class="block mb-1 font-medium">Pemakaian Rata / Hari</label>
    <input type="number" name="pemakaian_rata"
        value="{{ old('pemakaian_rata') }}"
        class="w-full border rounded-md px-3 py-2"
        required>
</div>

                {{-- SAFETY STOCK --}}
                <div class="mb-6">
                    <label class="block mb-1 font-medium">Safety Stock</label>
                    <input type="number" name="safety_stock"
                        value="{{ old('safety_stock') }}"
                        class="w-full border rounded-md px-3 py-2"
                        required>
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('obat.index') }}"
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