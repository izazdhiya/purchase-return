<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    protected $supplierModel;

    public function __construct()
    {
        $this->middleware('auth');
        $this->supplierModel = new Supplier();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allSupplier = $this->supplierModel->paginate(10);
        return view('pages.supplier.index', compact('allSupplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.supplier.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        try {
            DB::beginTransaction();

            $supplierId = $request->supplierId;
            $data = [
                'nama_supplier' => $request->nama_supplier,
                'alamat'        => $request->alamat,
                'email'         => $request->email
            ];

            if ($supplierId) {
                $this->supplierModel->updateData($supplierId, $data);
            } else {
                $this->supplierModel->create($data);
            }

            DB::commit();

            return redirect()->route('supplier.index')->with('success', 'Supplier berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in Supplier store method: ' . $th->getMessage());
            return redirect()->route('supplier.index')->with('error', 'Supplier gagal disimpan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = $this->supplierModel->find($id);
        return view('pages.supplier.form', compact('supplier'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->supplierModel->deleteSupplierById($id);

            DB::commit();

            return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in supplier destroy method: ' . $th->getMessage());
            return redirect()->route('supplier.index')->with('error', 'Supplier gagal dihapus');
        }
    }
}
