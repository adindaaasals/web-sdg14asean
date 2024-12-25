<?php

namespace App\Http\Controllers;
use App\Models\AquacultureProduction;
use App\Models\Countries;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CountryReportController extends Controller
{
    
    public function index()
    {
        // Ambil data negara dari database
        $allCountries = DB::table('countries')->select('country_name', 'country_flag')->get();

        // Debug data untuk memastikan data ada
        // dd($allCountries); // Cek apakah data benar-benar ada

        // Kirim data ke view
        return view('pages.report', compact('allCountries'));
    }
}