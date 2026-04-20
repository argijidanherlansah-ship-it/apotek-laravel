<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\TransaksiKeluar;

class RopController extends Controller
{
    public function index()
    {
        $obats = Obat::all(); // 🔥 HARUS obats (pakai S)

        foreach ($obats as $item) {

            $pemakaian = TransaksiKeluar::where('obat_id', $item->id)
                            ->pluck('jumlah');

            if ($pemakaian->count() > 0) {
                $max = $pemakaian->max();
                $rata = $pemakaian->avg();
            } else {
                $max = 0;
                $rata = 0;
            }

            $lead_time = 2;

            $ss = ($max - $rata) * $lead_time;
            $rop = ($lead_time * $rata) + $ss;

            $item->safety_stock = round($ss);
            $item->rop = round($rop);

            if ($item->stok <= $item->rop) {
                $item->status = 'Harus Pesan';
            
                // 🔥 PAKAI VARIABLE BARU (ANTI KETIMPA)
                $rekom = $item->rop - $item->stok;
            
                $item->rekomendasi = $rekom > 0 ? $rekom : 0;
            
            } else {
                $item->status = 'Aman';
                $item->rekomendasi = 0;
            }
        }

        return view('rop.index', compact('obats')); // 🔥 WAJIB obats
    }
}