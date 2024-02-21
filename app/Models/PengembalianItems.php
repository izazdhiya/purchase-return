<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianItems extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'pengembalian_id',
        'barang_id',
        'jumlah',
        'harga_satuan',
        'total',
    ];

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
