<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Pemesanan</h2>
    </x-slot>

    <div class="py-6 px-6">

        <form action="{{ route('pemesanan.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label>Obat</label>
                <select name="obat_id" class="w-full border p-2">
                    @foreach($obats as $o)
                        <option value="{{ $o->id }}">{{ $o->nama_obat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Supplier</label>
                <select name="supplier_id" class="w-full border p-2">
                    @foreach($suppliers as $s)
                        <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="w-full border p-2">
            </div>

            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Simpan
            </button>

        </form>

    </div>

</x-app-layout>