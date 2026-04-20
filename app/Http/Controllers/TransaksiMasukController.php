<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMasuk;
use App\Models\Obat;
use Illuminate\Http\Request;

class TransaksiMasukController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiMasuk::with('obat')->latest()->get();
        return view('transaksi_masuk.index', compact('transaksis'));
    }

    public function create()
    {
        $obats = Obat::all();
        return view('transaksi_masuk.create', compact('obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required',
            'jumlah'  => 'required|numeric|min:1',
            'tanggal' => 'required|date',
        ]);

        $obat = Obat::findOrFail($request->obat_id);

        // Simpan transaksi
        TransaksiMasuk::create([
            'obat_id' => $request->obat_id,
            'jumlah'  => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        // Tambah stok
        $obat->increment('stok', $request->jumlah);

        return redirect()->route('transaksi-masuk.index')
            ->with('success', 'Transaksi masuk berhasil disimpan');
    }

    public function destroy($id)
    {
        $transaksi = TransaksiMasuk::findOrFail($id);

        // Kurangi stok jika dihapus
        $transaksi->obat->decrement('stok', $transaksi->jumlah);

        $transaksi->delete();

        return back()->with('success', 'Transaksi berhasil dihapus');
    }
}