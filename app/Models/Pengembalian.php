<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';
    protected $guarded = ['id'];

    protected $fillable = [
        'tanggal_pengembalian',
        'pembelian_id',
        'total_pengembalian',
        'keterangan',
    ];

    public function pengembalianItems()
    {
        return $this->hasMany(PengembalianItems::class, 'pengembalian_id');
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }
}
