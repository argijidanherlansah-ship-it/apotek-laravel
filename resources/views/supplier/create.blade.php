<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Supplier
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="bg-white shadow rounded-lg p-6">

            <form action="{{ route('supplier.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">
                        Nama Supplier
                    </label>
                    <input type="text"
                           name="nama_supplier"
                           class="w-full border rounded-lg px-3 py-2"
                           placeholder="Masukkan nama supplier">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">
                        Alamat
                    </label>
                    <input type="text"
                           name="alamat"
                           class="w-full border rounded-lg px-3 py-2"
                           placeholder="Masukkan alamat">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">
                        Telepon
                    </label>
                    <input type="text"
                           name="telepon"
                           class="w-full border rounded-lg px-3 py-2"
                           placeholder="Masukkan nomor telepon">
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('supplier.index') }}"
                       class="mr-3 bg-gray-500 text-white px-4 py-2 rounded-lg">
                        Batal
                    </a>

                    <button type="submit"
                            class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>