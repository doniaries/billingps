<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1], // Agar selalu mengupdate baris yang sama, bukan menambah data ganda
            [
                'rental_name' => 'Gober Zone',
                'tv_count' => 5,
                'address' => 'jl.pasar inpres',
                'contact_number' => '0812345679',
                'owner_name' => 'Aulia Rahmat',
                'social_media' => ''
            ]
        );
    }
}
