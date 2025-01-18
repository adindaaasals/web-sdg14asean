<?php

namespace App\Http\Controllers;

use App\Models\Countries;
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
        $country_data = Countries::find($country);

        // Ambil data dari database berdasarkan country_name
        $marineProtectedArea = MarineProtectedAreas::where('country_id', $country)->first();

        // Ambil path file polygon
        $polygonPath = $marineProtectedArea ? Storage::url($marineProtectedArea->polygon_data_json) : null;

        return view('pages.mpa-country', [
            'country' => $country_data->country_name,
            'polygonData' => $polygonPath, // Path file JSON untuk peta
        ]);
    }

}
