<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'nama_supplier',
        'alamat',
        'email',
    ];

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'supplier_id');
    }

    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class, 'supplier_id');
    }
}
