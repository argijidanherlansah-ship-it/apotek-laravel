<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
Laporan Stok Obat
</h2>
</x-slot>

<div class="p-6">

<a href="{{ route('laporan.pdf') }}"
class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded mb-4 inline-block">
Download PDF
</a>

<form method="GET" class="mb-4 flex gap-3">

<input type="date" name="start_date"
class="border rounded px-3 py-2">

<input type="date" name="end_date"
class="border rounded px-3 py-2">

<button class="bg-purple-600 text-white px-4 py-2 rounded">
Filter
</button>
@if(request('start_date') && request('end_date'))
<p class="text-gray-500 mb-4">
Periode Laporan :
{{ request('start_date') }} sampai {{ request('end_date') }}
</p>

@endif

<button onclick="window.print()" 
class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
Print
</button>

</form>

<div class="bg-white p-6 rounded shadow">

<table class="w-full border">

<thead class="bg-purple-600 text-white">
<tr>
<th class="p-2">No</th>
<th class="p-2">Nama Obat</th>
<th class="p-2">Stok</th>
<th class="p-2">Safety Stock</th>
<th class="p-2">ROP</th>
<th class="p-2">Status</th>
</tr>
</thead>

<tbody>

@foreach($obats as $obat)

<tr class="text-center border-b">

<td>{{ $loop->iteration }}</td>
<td>{{ $obat->nama_obat }}</td>
<td>{{ $obat->stok }}</td>
<td>{{ $obat->safety_stock }}</td>
<td>{{ $obat->rop }}</td>

<td>

@if($obat->stok <= $obat->rop)

<span class="text-red-600 font-semibold">
Harus Pesan
</span>

@else

<span class="text-green-600 font-semibold">
Aman
</span>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</x-app-layout>