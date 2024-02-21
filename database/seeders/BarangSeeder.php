<?php

namespace Database\Seeders;

use App\Models\Barang;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $barang = new Barang();

        $data = ['Buku', 'Pulpen', 'Penggaris', 'Pensil', 'Penghapus', 'Spidol', 'Sampul', 'Botol', 'Tas', 'Kacamata'];

        for ($i = 0; $i < count($data); $i++) {
            $barang->create([
                'kode' => $faker->unique()->randomNumber(5, true),
                'nama_barang' => $data[$i],
                'stok' => 0,
            ]);
        }
    }
}
