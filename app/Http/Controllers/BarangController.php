<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    protected $barangModel;

    public function __construct()
    {
        $this->middleware('auth');
        $this->barangModel = new Barang();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allBarang = $this->barangModel->paginate(10);
        return view('pages.barang.index', compact('allBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.barang.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        try {
            DB::beginTransaction();

            $barangId = $request->barangId;
            $data = [
                'kode'          => $request->kode,
                'nama_barang'   => $request->nama_barang,
            ];

            if ($barangId) {
                $this->barangModel->updateData($barangId, $data);
            } else {
                $data['stok'] = 0;
                $this->barangModel->create($data);
            }

            DB::commit();

            return redirect()->route('barang.index')->with('success', 'Barang berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in Barang store method: ' . $th->getMessage());
            return redirect()->route('barang.index')->with('error', 'Barang gagal disimpan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barang = $this->barangModel->find($id);
        return view('pages.barang.form', compact('barang'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->barangModel->deleteBarangById($id);

            DB::commit();

            return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in Barang destroy method: ' . $th->getMessage());
            return redirect()->route('barang.index')->with('error', 'Barang gagal dihapus');
        }
    }
}
