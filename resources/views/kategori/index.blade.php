<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Kategori
        </h2>
    </x-slot>

    <div class="p-6">

        <!-- Notifikasi sukses -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Tambah -->
        <a href="{{ route('kategori.create') }}"
           class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
           + Tambah Kategori
        </a>

        <!-- Tabel -->
        <div class="mt-6 bg-white shadow rounded-lg p-4">
            <table class="w-full border">
                <thead>
                    <tr class="border-b bg-gray-100">
                        <th class="text-left p-2">No</th>
                        <th class="text-left p-2">Nama Kategori</th>
                        <th class="text-left p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                    <tr class="border-b">
                        <td class="p-2">{{ $loop->iteration }}</td>
                        <td class="p-2">{{ $kategori->nama_kategori }}</td>
                        <td class="p-2">

                            <!-- Edit -->
                            <a href="{{ route('kategori.edit', $kategori->id) }}"
                               class="text-blue-600 hover:underline">
                               Edit
                            </a>

                            <!-- Hapus -->
                            <form action="{{ route('kategori.destroy', $kategori->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')"
                                        class="text-red-600 ml-3 hover:underline">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            Belum ada data kategori
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>