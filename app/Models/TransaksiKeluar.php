<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'obat_id',
        'jumlah',
        'tanggal',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}