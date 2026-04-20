<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'obat_id',
        'supplier_id',
        'jumlah',
        'tanggal',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}