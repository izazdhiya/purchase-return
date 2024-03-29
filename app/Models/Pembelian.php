<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $guarded = ['id'];

    protected $fillable = [
        'tanggal_transaksi',
        'supplier_id',
        'total',
    ];

    public function pembelianItems()
    {
        return $this->hasMany(PembelianItems::class, 'pembelian_id');
    }

    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class, 'pembelian_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
