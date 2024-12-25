<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
// use App\Models\Maps;

// class GeojsonController extends Controller
// {
//     public function getGeojson($country)
//     {
//         $geojsonData = Maps::where('country_code', $country)->first(); // Menarik data berdasarkan negara
        
//         if ($geojsonData) {
//             // Decode geojson dari string ke array
//             $geoJsonDecoded = json_decode($geojsonData->geojson, true);  // Dekode GeoJSON menjadi array
        
//             // Pastikan 'features' dan 'geometry' ada
//             if (isset($geoJsonDecoded['features']) && !empty($geoJsonDecoded['features'])) {
//                 $feature = $geoJsonDecoded['features'][0];  // Ambil fitur pertama
//                 if (isset($feature['geometry'])) {
//                     // Lakukan sesuatu dengan geometry
//                     $geometry = $feature['geometry'];
//                     // Tambahkan ke GeoJSON atau proses lainnya
//                 } else {
//                     // Log error jika geometry tidak ada
//                     Log::debug('Geometry is missing for country: ' . $country);
//                 }
//             } else {
//                 Log::debug('No features found for country: ' . $country);
//             }
//         } else {
//             Log::debug('GeoJSON not found for country: ' . $country);
//     }
// }
// }
