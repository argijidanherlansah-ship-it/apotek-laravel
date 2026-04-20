<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Pemesanan Obat
        </h2>
    </x-slot>

    <div class="py-6 px-6">

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('pemesanan.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Pemesanan
        </a>

        <div class="bg-white p-6 rounded shadow">

            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2">No</th>
                        <th class="p-2">Obat</th>
                        <th class="p-2">Supplier</th>
                        <th class="p-2">Jumlah</th>
                        <th class="p-2">Tanggal</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $item)
                    <tr class="text-center border-b">
                        <td class="p-2">{{ $loop->iteration }}</td>
                        <td class="p-2">{{ $item->obat->nama_obat }}</td>
                        <td class="p-2">{{ $item->supplier->nama_supplier }}</td>
                        <td class="p-2">{{ $item->jumlah }}</td>
                        <td class="p-2">{{ $item->tanggal }}</td>

                        {{-- STATUS --}}
                        <td class="p-2">
                            @if($item->status == 'pending')
                                <span class="bg-yellow-400 text-white px-2 py-1 rounded">
                                    Pending
                                </span>
                            @else
                                <span class="bg-green-500 text-white px-2 py-1 rounded">
                                    Diterima
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="p-2 space-x-1">

                            {{-- TERIMA --}}
                            @if($item->status == 'pending')
                                <a href="{{ route('pemesanan.terima', $item->id) }}" 
                                   class="bg-green-500 text-white px-2 py-1 rounded">
                                    Terima
                                </a>
                            @endif

                            {{-- EDIT --}}
                            <a href="{{ route('pemesanan.edit', $item->id) }}" 
                               class="bg-blue-500 text-white px-2 py-1 rounded">
                                Edit
                            </a>

                            {{-- HAPUS --}}
                            <form action="{{ route('pemesanan.destroy', $item->id) }}" 
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus data?')" 
                                        class="bg-red-500 text-white px-2 py-1 rounded">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

</x-app-layout>