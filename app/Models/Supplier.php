<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'supplier';
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

    public function updateData($id, $data)
    {
        $supplier = $this->find($id);
        $supplier->update($data);
        return $supplier;
    }

    public function deleteSupplierById($id)
    {
        $supplier = $this->withTrashed()->find($id);
        $supplier->pembelian()->delete();
        $supplier->delete();
        return $supplier;
    }
}
