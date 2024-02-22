<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianItems;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    protected $pembelianModel;
    protected $supplierModel;
    protected $pembelianItemModel;

    public function __construct()
    {
        $this->middleware('auth');
        $this->pembelianModel = new Pembelian();
        $this->supplierModel = new Supplier();
        $this->pembelianItemModel = new PembelianItems();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPembelian = $this->pembelianModel->paginate(10);
        return view('pages.pembelian.index', compact('allPembelian')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allSupplier = $this->supplierModel->all();
        return view('pages.pembelian.form', compact('allSupplier')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pembelian = $this->pembelianModel->find($id);
        $allItemPembelian = $this->pembelianItemModel->getItemByPembelianId($id);
        return view('pages.pembelian.detail', compact('allItemPembelian', 'pembelian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
