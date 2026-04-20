<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\TransaksiKeluar;

class DashboardController extends Controller
{
    public function index()
    {

        $grafik = TransaksiKeluar::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('SUM(jumlah) as total')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        $labels = [];
        $data = [];

        foreach ($grafik as $g) {
            $labels[] = 'Bulan ' . $g->bulan;
            $data[] = $g->total;
        }

        return view('dashboard', compact('labels','data'));
    }
}