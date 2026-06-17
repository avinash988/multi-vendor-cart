<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        Vendor::create([
            'name' => 'Vendor A',
            'email' => 'vendora@test.com',
            'phone' => '9999999991'
        ]);

        Vendor::create([
            'name' => 'Vendor B',
            'email' => 'vendorb@test.com',
            'phone' => '9999999992'
        ]);
    }
}