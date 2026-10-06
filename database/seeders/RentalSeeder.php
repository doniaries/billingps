<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;
use App\Models\Package;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        // Data TV
        Device::create(['name' => 'TV 1 - PS 4', 'ip_address' => '192.168.100.11', 'status' => 'available']);
        Device::create(['name' => 'TV 2 - PS 4', 'ip_address' => '192.168.100.12', 'status' => 'available']);
        Device::create(['name' => 'TV 3 - PS 5', 'ip_address' => '192.168.100.13', 'status' => 'available']);
        Device::create(['name' => 'TV 4 - PS 5', 'ip_address' => '192.168.100.14', 'status' => 'available']);

        // Data Paket
        Package::create(['name' => 'Paket 1 Jam', 'duration_minutes' => 60, 'price' => 5000]);
        Package::create(['name' => 'Paket 2 Jam', 'duration_minutes' => 120, 'price' => 10000]);
        Package::create(['name' => 'Paket 3 Jam', 'duration_minutes' => 180, 'price' => 13000]);
        Package::create(['name' => 'Paket Begadang (6 Jam)', 'duration_minutes' => 360, 'price' => 25000]);
    }
}
