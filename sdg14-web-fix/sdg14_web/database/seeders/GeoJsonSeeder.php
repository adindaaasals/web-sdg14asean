<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Maps;
use App\Models\Countries;
use Illuminate\Support\Facades\File;

class GeoJsonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Baca file GeoJSON
        $geojsonFile = storage_path('app/asean_countries.geojson');
        $geojsonData = json_decode(File::get($geojsonFile), true);

        // Loop setiap fitur dalam GeoJSON dan masukkan ke tabel maps
        foreach ($geojsonData['features'] as $feature) {
            $countryCode = $feature['properties']['ISO_A3'];
            $countryName = $feature['properties']['NAME'];

            // Pastikan negara sudah ada di tabel countries
            $country = Countries::where('country_code', $countryCode)->first();

            if ($country) {
                Maps::updateOrCreate(
                    ['country_code' => $countryCode],  // Pastikan country_code unik
                    [
                        'country_name' => $countryName,
                        'geojson' => json_encode($feature)  // Masukkan geojson
                    ]
                );
            }
        }
    }
}
