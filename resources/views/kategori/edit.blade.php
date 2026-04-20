<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kategori
        </h2>
    </x-slot>

    <div class="p-6">

        <div class="bg-white shadow rounded-lg p-6">

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">
                        Nama Kategori
                    </label>

                    <input type="text"
                           name="nama_kategori"
                           value="{{ $kategori->nama_kategori }}"
                           class="w-full border rounded-lg px-3 py-2">

                    @error('nama_kategori')
                        <div class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('kategori.index') }}"
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
