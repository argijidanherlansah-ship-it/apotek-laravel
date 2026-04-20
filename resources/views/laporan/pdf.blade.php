<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Laporan Stok Obat</title>

<style>

body{
font-family: Arial;
}

table{
width:100%;
border-collapse: collapse;
}

th,td{
border:1px solid black;
padding:8px;
text-align:center;
}

th{
background:#6D28D9;
color:white;
}

</style>

</head>

<body>

<h2 style="text-align:center">
Laporan Stok Obat
</h2>

<table>

<thead>

<tr>
<th>No</th>
<th>Nama Obat</th>
<th>Stok</th>
<th>Safety Stock</th>
<th>ROP</th>
<th>Status</th>
</tr>

</thead>

<tbody>

@foreach($obats as $obat)

<tr>

<td>{{ $loop->iteration }}</td>
<td>{{ $obat->nama_obat }}</td>
<td>{{ $obat->stok }}</td>
<td>{{ $obat->safety_stock }}</td>
<td>{{ $obat->rop }}</td>

<td>

@if($obat->stok <= $obat->rop)
Harus Pesan
@else
Aman
@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html>