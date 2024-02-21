<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengembalian_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('pengembalian_id')->constrained('pembelian');
            $table->foreignId('barang_id')->constrained('barang');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 19, 2);
            $table->decimal('total', 19, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_items');
    }
};
