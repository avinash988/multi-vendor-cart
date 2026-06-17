<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Customer',
            'email' => 'customer@test.com',
            'password' => bcrypt('123456'),
            'role' => 'customer'
        ]);

        $this->call([
            VendorSeeder::class,
            ProductSeeder::class
        ]);
    }
}