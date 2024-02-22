<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianItemsController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('barang.index'));
});

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::resource('barang', BarangController::class)->except(['create','store', 'show', 'update'])->middleware('role:admin|pergudangan|pengiriman');
    Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create')->middleware('role:admin');
    Route::post('barang/store', [BarangController::class, 'store'])->name('barang.store')->middleware('role:admin');

    Route::resource('supplier', SupplierController::class)->middleware('role:admin');

    Route::resource('pembelian', PembelianController::class)->except(['create','store'])->middleware('role:admin|pergudangan');
    Route::get('pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create')->middleware('role:admin');
    Route::post('pembelian/store', [PembelianController::class, 'store'])->name('pembelian.store')->middleware('role:admin');
});
