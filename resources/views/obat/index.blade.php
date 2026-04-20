<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Obat
        </h2>
    </x-slot>

    <div class="py-6 px-6">

        <a href="{{ route('obat.create') }}"
           class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md">
            + Tambah Obat
        </a>

        <div class="mt-6 bg-white shadow rounded-lg overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Obat</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Supplier</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Stok</th>
                        <th class="px-4 py-2">Safety Stock</th>
                        <th class="px-4 py-2">ROP</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($obats as $obat)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $obat->nama_obat }}</td>
                            <td class="px-4 py-2">{{ $obat->kategori->nama_kategori ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $obat->supplier->nama_supplier ?? '-' }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $obat->stok }}</td>
                            <td class="px-4 py-2">{{ $obat->safety_stock }}</td>
                            <td class="px-4 py-2">{{ $obat->rop }}</td>
                            <td class="px-4 py-2">
                                @if($obat->stok <= $obat->rop)
                                    <span class="text-red-600 font-semibold">
                                        Perlu Restock
                                    </span>
                                @else
                                    <span class="text-green-600 font-semibold">
                                        Aman
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('obat.edit', $obat->id) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                   Edit
                                </a>

                                <form action="{{ route('obat.destroy', $obat->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin mau hapus data ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 ml-2">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                Belum ada data obat
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>