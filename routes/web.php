<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TransaksiKeluarController;
use App\Http\Controllers\TransaksiMasukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\RopController;
use App\Http\Controllers\SettingController;

use App\Models\Obat;
use App\Models\Supplier;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiKeluar;
use App\Models\User;

use App\Notifications\StokMenipisNotification;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEB ROUTES (DEBUG MODE 🚨)
|--------------------------------------------------------------------------
*/

// ================= ROOT DEBUG =================
Route::get('/', function () {
    try {
        return "APLIKASI HIDUP 🚀";
    } catch (\Throwable $e) {
        return "ERROR ROOT: " . $e->getMessage();
    }
});

// ================= FITUR =================
Route::get('/fitur', function () {
    try {
        return view('fitur');
    } catch (\Throwable $e) {
        return "ERROR FITUR: " . $e->getMessage();
    }
})->name('fitur');


// ================= AUTH =================
Route::middleware(['auth','verified'])->group(function () {

    // ================= DASHBOARD DEBUG =================
    Route::get('/dashboard', function () {

        try {

            // BASIC DATA
            $totalObat = Obat::count();
            $totalSupplier = Supplier::count();
            $totalMasuk = TransaksiMasuk::count();
            $totalKeluar = TransaksiKeluar::count();

            // ================= GRAFIK OBAT =================
            $grafik = TransaksiKeluar::selectRaw('obat_id, SUM(jumlah) as total')
                ->groupBy('obat_id')
                ->with('obat')
                ->get();

            $labels = [];
            $data = [];

            foreach ($grafik as $g) {
                if ($g->obat) {
                    $labels[] = $g->obat->nama_obat ?? '-';
                    $data[] = $g->total ?? 0;
                }
            }

            // ================= GRAFIK BULAN =================
            $grafikBulanan = TransaksiKeluar::selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total')
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();

            $namaBulan = [
                1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',
                7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
            ];

            $bulanLabels = array_values($namaBulan);
            $bulanData = array_fill(1, 12, 0);

            foreach ($grafikBulanan as $b) {
                $bulanData[$b->bulan] = $b->total ?? 0;
            }

            $bulanData = array_values($bulanData);

            // ================= STOK MINIMUM =================
            $stokMinimum = Obat::whereColumn('stok','<=','safety_stock')->get();

            // ================= NOTIF SAFE =================
            try {
                $gudangs = User::where('role','gudang')->get();
                foreach ($stokMinimum as $obat) {
                    foreach ($gudangs as $gudang) {
                        $gudang->notify(new StokMenipisNotification($obat));
                    }
                }
            } catch (\Throwable $e) {
                // skip notif kalau error
            }

            // ================= INSIGHT =================
            $obatTerlaris = TransaksiKeluar::selectRaw('obat_id, SUM(jumlah) as total')
                ->groupBy('obat_id')
                ->orderByDesc('total')
                ->with('obat')
                ->first();

            $insight = null;
            if ($obatTerlaris && $obatTerlaris->obat) {
                $insight = "Obat paling banyak digunakan adalah "
                    . ($obatTerlaris->obat->nama_obat ?? '-') .
                    " sebanyak " . ($obatTerlaris->total ?? 0) . " unit.";
            }

            // ================= TOP OBAT =================
            $topObat = TransaksiKeluar::selectRaw('obat_id, SUM(jumlah) as total')
                ->groupBy('obat_id')
                ->orderByDesc('total')
                ->with('obat')
                ->take(5)
                ->get();

            // ================= ROP =================
            $rekomendasiPesan = Obat::whereColumn('stok','<=','rop')->get();
            $totalHarusPesan = $rekomendasiPesan->count();

            return view('dashboard', compact(
                'totalObat',
                'totalSupplier',
                'totalMasuk',
                'totalKeluar',
                'labels',
                'data',
                'stokMinimum',
                'bulanLabels',
                'bulanData',
                'topObat',
                'rekomendasiPesan',
                'insight',
                'totalHarusPesan'
            ));

        } catch (\Throwable $e) {

            return response()->json([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
        }

    })->name('dashboard');


    // ================= SETTING =================
    Route::middleware('role:admin')->group(function () {

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::post('/setting/update', [SettingController::class, 'update'])->name('setting.update');

    });


    // ================= PROFILE =================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // ================= ROP =================
    Route::get('/analisis-rop', [RopController::class, 'index'])->name('analisis.rop');


    // ================= ADMIN + GUDANG =================
    Route::middleware('role:admin,gudang')->group(function () {

        Route::resource('kategori', KategoriController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('obat', ObatController::class);
        Route::resource('pemesanan', PemesananController::class);

        Route::get('/pemesanan/{id}/terima', [PemesananController::class, 'terima'])
            ->name('pemesanan.terima');
    });


    // ================= ADMIN + KASIR =================
    Route::middleware('role:admin,kasir')->group(function () {

        Route::resource('transaksi-keluar', TransaksiKeluarController::class);
        Route::resource('transaksi-masuk', TransaksiMasukController::class);
    });


    // ================= LAPORAN =================
    Route::middleware('role:admin,owner,kasir,gudang')->group(function () {

        Route::get('/laporan-stok', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan-stok/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');
    });

});

require __DIR__.'/auth.php';