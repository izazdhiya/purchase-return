<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\PembelianItems;
use App\Models\Supplier;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $pembelian = new Pembelian();
        $pembelianItems = new PembelianItems();
        $supplier = new Supplier();
        $barang = new Barang();

        $supplierId = $supplier->pluck('id')->toArray();
        $barangId = $barang->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            $newPembelian = $pembelian->create([
                'tanggal_transaksi' => $faker->date(),
                'no_faktur' => $faker->unique()->randomNumber(8),
                'supplier_id' => $faker->randomElement($supplierId),
                'total' => 0
            ]);

            $arrayTotal = [];

            for ($j = 0; $j < 3; $j++) {
                $quantity = $faker->numberBetween(1, 20);
                $hargaSatuan = $faker->numberBetween(10000, 1000000);
                $total = $quantity * $hargaSatuan;
                $arrayTotal[] = $total;

                $itemBarangId = $faker->randomElement($barangId);
                $itemBarang = Barang::find($itemBarangId);
                $itemBarang->update(['stok' => $itemBarang->stok + $quantity]);

                $pembelianItems->create([
                    'pembelian_id' => $newPembelian->id,
                    'barang_id' => $itemBarangId,
                    'quantity' => $quantity,
                    'harga_satuan' => $hargaSatuan,
                    'sub_total' => $total
                ]);
            }

            $totalPembelian = array_sum($arrayTotal);

            Pembelian::find($newPembelian->id)->update(['total' => $totalPembelian]);

        }
    }
}
