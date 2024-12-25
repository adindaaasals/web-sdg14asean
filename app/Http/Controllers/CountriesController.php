<?php

namespace App\Http\Controllers;
use App\Models\AquacultureProduction;
use App\Models\Countries;

use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'country_name' => 'required',
        'country_code' => 'required|string|size:3',
        'aquaculture_production_2020' => 'required|numeric',
        'aquaculture_production_2021' => 'required|numeric',
        'aquaculture_production_2022' => 'required|numeric',
        'total_fisheries_production_2020' => 'required|numeric',
        'total_fisheries_production_2021' => 'required|numeric',
        'total_fisheries_production_2022' => 'required|numeric',
        'marine_protected_areas_2020' => 'required|numeric',
        'marine_protected_areas_2021' => 'required|numeric',
        'marine_protected_areas_2022' => 'required|numeric',
        'capture_fisheries_production_2020' => 'required|numeric',
        'capture_fisheries_production_2021' => 'required|numeric',
        'capture_fisheries_production_2022' => 'required|numeric',

    ]);

    return redirect()->route('countries.index')->with('success'); // Redirect ke halaman list negara
}

}
