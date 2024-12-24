<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MarineProtectedAreas;
use App\Models\Maps; 
use Illuminate\Http\Request;

class MarineProtectedAreasController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter tahun dari request
        $year = $request->input('year', '2022'); // Default ke 2022 jika tidak ada parameter tahun

        // Validasi tahun yang tersedia
        $availableYears = ['2020', '2021', '2022'];
        if (!in_array($year, $availableYears)) {
            return response()->json(['error' => 'Invalid year parameter'], 400);
        }

        // Ambil data dari model berdasarkan tahun
        $data = MarineProtectedAreas::select('country_code', 'country_name', "marine_protected_areas_{$year} as value")->get();

        // Ambil data GeoJSON dari tabel maps di database
        $geoJsonData = Maps::select('country_code', 'geojson')->get();

        // Buat array untuk geojson hasil gabungan
        $geoJson = [
            "type" => "FeatureCollection",
            "features" => []
        ];

        // Gabungkan data produksi dengan data GeoJSON berdasarkan 'country_code'
        foreach ($data as $item) {
            foreach ($geoJsonData as $map) {
                if ($map->country_code === $item->country_code) {
                    // Gabungkan data indikator dengan geoJSON
                    $geoJson['features'][] = [
                        "type" => "Feature",
                        "properties" => [
                            "name" => $item->country_name,
                            "value" => $item->value
                        ],
                        "geometry" => json_decode($map->geojson) // Ambil geometry dari tabel maps
                    ];
                    break; // Setelah cocok, tidak perlu lanjut ke fitur lainnya
                }
            }
        }

        // Return data dalam format GeoJSON
        return response()->json($geoJson);
    }

    // Mendapatkan data berdasarkan ID
    public function show($id)
    {
        $data = MarineProtectedAreas::find($id);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }
}
