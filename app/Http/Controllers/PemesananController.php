<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Obat;
use App\Models\Supplier;

class PemesananController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $data = Pemesanan::with('obat','supplier')->latest()->get();
        return view('pemesanan.index', compact('data'));
    }

    // ================= CREATE =================
    public function create()
    {
        $obats = Obat::all();
        $suppliers = Supplier::all();

        return view('pemesanan.create', compact('obats','suppliers'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required',
            'supplier_id' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Pemesanan::create([
            'obat_id' => $request->obat_id,
            'supplier_id' => $request->supplier_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'status' => 'pending' // 🔥 WAJIB
        ]);

        return redirect()->route('pemesanan.index')
            ->with('success','Pemesanan berhasil ditambahkan');
    }

    // ================= TERIMA BARANG 🔥 =================
    public function terima($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // TAMBAH STOK OBAT
        $obat = Obat::findOrFail($pemesanan->obat_id);
        $obat->stok += $pemesanan->jumlah;
        $obat->save();

        // UPDATE STATUS
        $pemesanan->status = 'diterima';
        $pemesanan->save();

        return redirect()->back()->with('success', 'Barang berhasil diterima & stok bertambah');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        Pemesanan::findOrFail($id)->delete();

        return back()->with('success','Data berhasil dihapus');
    }
}