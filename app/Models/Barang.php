<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'barang';
    protected $guarded = ['id'];

    protected $fillable = [
        'kode',
        'nama_barang',
        'stok',
    ];

    public function pembelianItems()
    {
        return $this->hasMany(PembelianItems::class, 'barang_id');
    }

    public function pengembalianItems()
    {
        return $this->hasMany(PengembalianItems::class, 'barang_id');
    }

    public function updateData($id, $data)
    {
        $barang = $this->find($id);
        $barang->update($data);
        return $barang;
    }

    public function deleteBarangById($id)
    {
        $barang = $this->withTrashed()->find($id);
        $barang->pembelianItems()->delete();
        $barang->pengembalianItems()->delete();
        $barang->delete();
        return $barang;
    }



}
