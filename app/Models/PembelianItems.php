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
        'quantity',
        'harga_satuan',
        'sub_total',
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function getItemByPembelianId($pembelianId)
    {
        $itemPembelian = $this->where('pembelian_id', $pembelianId)->paginate(10);
        return $itemPembelian;
    }
}
