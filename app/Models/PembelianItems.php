<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianItems extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'pembelian_id',
        'barang_id',
        'jumlah',
        'harga_satuan',
        'total',
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
