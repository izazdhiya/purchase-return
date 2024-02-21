<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
