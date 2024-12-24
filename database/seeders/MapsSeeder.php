<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Countries;
use App\Models\Maps;

class MapsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data country_code dan country_name dari tabel countries
        $countries = Countries::all();

        foreach ($countries as $country) {
            // Insert data ke tabel maps
            Maps::updateOrCreate(
                ['country_code' => $country->country_code], // Menjaga agar country_code unik
                [
                    'country_name' => $country->country_name, // Masukkan country_name
                    'geojson' => null, // Anda bisa menambahkan nilai default untuk geojson
                ]
            );
        }
    }
}
