<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'uuid'      => Str::uuid(),
            'name'      => "Homes Platinum Banjarbaru",
            'address'   => "Jl. Seroja, No.20 (bagian depan), Banjarbaru, Kalimantan Selatan",
            'image'     => "",
            'phone'     => "082143419551",
            'instagram_id' => "homes.headoffice",
            'location' => json_encode(['lat' => '-3.4417829', 'lng' => '114.8359605']),
        ]);

        Store::create([
            'uuid'      => Str::uuid(),
            'name'      => "Homes Platinum Banjarmasin",
            'address'   => "Jl. Sultan Adam, Komp. Andhika No.03, Kota Banjarmasin, Kalimantan Selatan",
            'image'     => "",
            'phone'     => "082143419551",
            'instagram_id' => "homes.headoffice",
            'location' => json_encode(['lat' => '-3.2913072', 'lng' => '114.5982621']),
        ]);

        Store::create([
            'uuid'      => Str::uuid(),
            'name'      => "Homes Platinum Intan Sari",
            'address'   => "Jalan Intansari, Banjarbaru, South Kalimantan",
            'image'     => "",
            'phone'     => "082143419551",
            'instagram_id' => "homes.headoffice",
            'location' => json_encode(['lat' => '-3.4495552', 'lng' => '114.8400449']),
        ]);

        Store::create([
            'uuid'      => Str::uuid(),
            'name'      => "Homes Platinum RSI Sultan Agung",
            'address'   => "Jl. A. Yani Km. 17,5, Komplek Kota Citra Graha, Banjarbaru, Kalimantan Selatan",
            'image'     => "",
            'phone'     => "082143419551",
            'instagram_id'  => "homes.headoffice",
            'location'      => NULL,
        ]);
    }
}
