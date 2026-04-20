<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'nama_obat',
        'kategori_id',
        'supplier_id',
        'stok',
        'stok_minimum',
        'pemakaian_rata',
        'lead_time',
        'safety_stock',
        'rop',
        'harga'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function transaksiKeluar()
    {
    return $this->hasMany(TransaksiKeluar::class);
    }

    public function transaksiMasuk()
    {
    return $this->hasMany(TransaksiMasuk::class);
    }
}