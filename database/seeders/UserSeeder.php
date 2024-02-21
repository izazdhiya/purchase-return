<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();

        $user->create([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ]);

        $user->create([
            'name' => 'gudang',
            'role' => 'pergudangan',
            'email' => 'gudang@example.com',
            'password' => bcrypt('admin'),
        ]);

        $user->create([
            'name' => 'admin',
            'role' => 'pengiriman',
            'email' => 'kurir@example.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
