<?php

namespace Database\Seeders;

use App\Models\Geolocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeolocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Geolocation::insert([
            [
                "village" => "cageur",
                "subdistrict" => "darma",
                "district" => "kuningan",
                "longitude" => "108.3968682",
                "latitude"=> "-7.0521133",
            ],
            [
                "village" => "sukarasa",
                "subdistrict" => "darma",
                "district" => "kuningan",
                "longitude" => "108.3849141",
                "latitude"=> "-7.0390228",
            ]
        ]);
    }
}
