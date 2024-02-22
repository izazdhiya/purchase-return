<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $supplier = new Supplier();

        for ($i = 0; $i < 3; $i++) {
            $supplier->create([
                'nama_supplier' => $faker->company(),
                'alamat' => $faker->address(),
                'email' => $faker->email(),
            ]);
        }
    }
}
