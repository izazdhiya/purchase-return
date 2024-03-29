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
        Schema::create('pembelian_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('pembelian_id')->constrained('pembelian');
            $table->foreignId('barang_id')->constrained('barang');
            $table->integer('quantity');
            $table->decimal('harga_satuan', 19, 2);
            $table->decimal('sub_total', 19, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_items');
    }
};
