<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'kode',
        'nama_barang',
    ];

    public function pembelianItems()
    {
        return $this->hasMany(PembelianItems::class, 'barang_id');
    }

    public function pengembalianItems()
    {
        return $this->hasMany(PengembalianItems::class, 'barang_id');
    }




}
