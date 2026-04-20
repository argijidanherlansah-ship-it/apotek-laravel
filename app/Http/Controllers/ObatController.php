<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    // =========================
    // INDEX (AUTO HITUNG SS & ROP)
    // =========================
    public function index()
    {
        $obats = Obat::with(['kategori', 'supplier'])->get();

        foreach ($obats as $obat) {

            // Ambil transaksi keluar berdasarkan obat
            $pemakaian = TransaksiKeluar::where('obat_id', $obat->id)
                ->pluck('jumlah');

            if ($pemakaian->count() > 0) {

                $max = $pemakaian->max();   // Pemakaian maksimum
                $avg = $pemakaian->avg();   // Pemakaian rata-rata

                // SAFETY STOCK
                $ss = ($max - $avg) * $obat->lead_time;

                // ROP
                $rop = ($obat->lead_time * $avg) + $ss;

                // Update database
                $obat->safety_stock = round($ss);
                $obat->rop = round($rop);
                $obat->save();
            }
        }

        return view('obat.index', compact('obats'));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $kategoris = Kategori::all();
        $suppliers = Supplier::all();

        return view('obat.create', compact('kategoris', 'suppliers'));
    }

    // =========================
    // STORE (TANPA INPUT SS & ROP)
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat'      => 'required',
            'kategori_id'    => 'required',
            'supplier_id'    => 'required',
            'stok'           => 'required|numeric',
            'lead_time'      => 'required|numeric',
            'harga'          => 'required|numeric',
        ]);

        Obat::create([
            'nama_obat'      => $request->nama_obat,
            'kategori_id'    => $request->kategori_id,
            'supplier_id'    => $request->supplier_id,
            'stok'           => $request->stok,
            'lead_time'      => $request->lead_time,
            'safety_stock'   => 0, // default dulu
            'rop'            => 0, // nanti auto hitung
            'harga'          => $request->harga,
        ]);

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil ditambahkan');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        $kategoris = Kategori::all();
        $suppliers = Supplier::all();

        return view('obat.edit', compact('obat', 'kategoris', 'suppliers'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat'      => 'required',
            'kategori_id'    => 'required',
            'supplier_id'    => 'required',
            'stok'           => 'required|numeric',
            'lead_time'      => 'required|numeric',
            'harga'          => 'required|numeric',
        ]);

        $obat = Obat::findOrFail($id);

        $obat->update([
            'nama_obat'      => $request->nama_obat,
            'kategori_id'    => $request->kategori_id,
            'supplier_id'    => $request->supplier_id,
            'stok'           => $request->stok,
            'lead_time'      => $request->lead_time,
            'harga'          => $request->harga,
        ]);

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil diupdate');
    }

    // =========================
    // DESTROY
    // =========================
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil dihapus');
    }
}