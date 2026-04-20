<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{

    // HALAMAN LAPORAN
    public function index()
    {
        $obats = Obat::all();

        return view('laporan.index', compact('obats'));
    }


    // EXPORT PDF
    public function pdf()
    {
        $obats = Obat::all();

        $pdf = Pdf::loadView('laporan.pdf', compact('obats'));

        return $pdf->download('laporan_stok_obat.pdf');
    }
}