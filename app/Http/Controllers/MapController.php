<?php

namespace App\Http\Controllers;
use App\Models\MarineProtectedAreas;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function showReport($country_name)
    {
        // Ambil semua data negara dari database
        $countries = MarineProtectedAreas::all();

        // Kirim data ke view
        return view('pages.report-country', [
            'countries' => $countries, // Koleksi data negara
            'country' => $country_name // Nama negara yang dipilih
        ]);
    }

    public function showMPA($country)
    {
        // Ambil data dari database berdasarkan country_name
        $marineProtectedArea = MarineProtectedAreas::where('country_name', $country)->first();

        // Ambil path file polygon
        $polygonPath = $marineProtectedArea ? asset('storage/' . $marineProtectedArea->polygon_data) : null;

        return view('pages.mpa-country', [
            'country' => $country,
            'polygonData' => $polygonPath, // Path file JSON untuk peta
        ]);
    }

}
