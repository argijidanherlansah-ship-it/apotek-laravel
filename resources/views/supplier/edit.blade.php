<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Supplier
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="bg-white shadow rounded-lg p-6">

            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">
                        Nama Supplier
                    </label>
                    <input type="text"
                           name="nama_supplier"
                           value="{{ $supplier->nama_supplier }}"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">
                        Alamat
                    </label>
                    <input type="text"
                           name="alamat"
                           value="{{ $supplier->alamat }}"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">
                        Telepon
                    </label>
                    <input type="text"
                           name="telepon"
                           value="{{ $supplier->telepon }}"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('supplier.index') }}"
                       class="mr-3 bg-gray-500 text-white px-4 py-2 rounded-lg">
                        Batal
                    </a>

                    <button type="submit"
                            class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>