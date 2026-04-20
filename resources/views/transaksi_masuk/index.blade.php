<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Transaksi Masuk
        </h2>
    </x-slot>

    <div class="py-6 px-6">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Daftar Transaksi Masuk</h3>

            <a href="{{ route('transaksi-masuk.create') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md">
                + Tambah Transaksi
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Obat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transaksis as $transaksi)
                        <tr>
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium">
                                {{ $transaksi->obat->nama_obat }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaksi->jumlah }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('transaksi-masuk.destroy', $transaksi->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus transaksi?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 font-medium">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Belum ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>