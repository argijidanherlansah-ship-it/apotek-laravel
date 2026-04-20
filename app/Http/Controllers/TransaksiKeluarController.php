<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKeluar;
use App\Models\Obat;
use Illuminate\Http\Request;

class TransaksiKeluarController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiKeluar::with('obat')->latest()->get();
        return view('transaksi_keluar.index', compact('transaksis'));
    }

    public function create()
    {
        $obats = Obat::all();
        return view('transaksi_keluar.create', compact('obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required',
            'jumlah'  => 'required|numeric|min:1',
            'tanggal' => 'required|date',
        ]);

        $obat = Obat::findOrFail($request->obat_id);

        // CEK STOK
        if ($request->jumlah > $obat->stok) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi']);
        }

        // SIMPAN TRANSAKSI
        TransaksiKeluar::create([
            'obat_id' => $request->obat_id,
            'jumlah'  => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        // KURANGI STOK
        $obat->decrement('stok', $request->jumlah);


        /* =====================================
           HITUNG RATA PENJUALAN OTOMATIS
        ===================================== */

        $total_keluar = TransaksiKeluar::where('obat_id', $request->obat_id)
                        ->sum('jumlah');

        $jumlah_hari = TransaksiKeluar::where('obat_id', $request->obat_id)
                        ->distinct('tanggal')
                        ->count('tanggal');

        $rata_penjualan = $jumlah_hari > 0 
            ? $total_keluar / $jumlah_hari 
            : 0;


        /* =====================================
           HITUNG ROP
        ===================================== */

        $rop = ($rata_penjualan * $obat->lead_time) + $obat->safety_stock;


        /* =====================================
           UPDATE DATA OBAT
        ===================================== */

        $obat->update([
            'rata_penjualan' => round($rata_penjualan,2),
            'rop' => ceil($rop)
        ]);


        return redirect()->route('transaksi-keluar.index')
            ->with('success', 'Transaksi berhasil disimpan');
    }

    public function destroy($id)
    {
        $transaksi = TransaksiKeluar::findOrFail($id);

        // KEMBALIKAN STOK
        $transaksi->obat->increment('stok', $transaksi->jumlah);

        $transaksi->delete();

        return back()->with('success', 'Transaksi berhasil dihapus');
    }
}