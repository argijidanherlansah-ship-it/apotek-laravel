<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Supplier
        </h2>
    </x-slot>

    <div class="p-6">

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('supplier.create') }}"
           class="bg-purple-600 text-white px-4 py-2 rounded-lg">
           + Tambah Supplier
        </a>

        <div class="mt-6 bg-white shadow rounded-lg p-4">
            <table class="w-full border">
                <thead>
                    <tr class="border-b bg-gray-100">
                        <th class="p-2">No</th>
                        <th class="p-2">Nama</th>
                        <th class="p-2">Alamat</th>
                        <th class="p-2">Telepon</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                    <tr class="border-b">
                        <td class="p-2">{{ $loop->iteration }}</td>
                        <td class="p-2">{{ $supplier->nama_supplier }}</td>
                        <td class="p-2">{{ $supplier->alamat }}</td>
                        <td class="p-2">{{ $supplier->telepon }}</td>
                        <td class="p-2">
                            <a href="{{ route('supplier.edit', $supplier->id) }}"
                               class="text-blue-600">Edit</a>

                            <form action="{{ route('supplier.destroy', $supplier->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')"
                                        class="text-red-600 ml-2">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-500">
                            Belum ada data supplier
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>