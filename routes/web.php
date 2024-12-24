<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AquacultureProductionController;
use App\Http\Controllers\Api\CaptureFisheriesProductionController;
use App\Http\Controllers\Api\MarineProtectedAreasController;
use App\Http\Controllers\Api\TotalFisheriesProductionController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\GeojsonController;
use App\Models\AquacultureProduction;
use App\Models\CaptureFisheriesProduction;
use App\Models\MarineProtectedAreas;
use App\Models\TotalFisheriesProduction;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');

Route::get('/abooutus', function () {
    return view('pages.aboutUs'); 
})->name('pages.aboutUs');

Route::get('/maps', function () {
    return view('pages.maps');
})->name('pages.maps');

Route::prefix('api')->group(function () {
    // Route::get('/geojson/{country}', [GeojsonController::class, 'getGeojson']);

    Route::get('/aquaculture-production', [AquacultureProductionController::class, 'index']);
    Route::get('/aquaculture-production/{id}', [AquacultureProductionController::class, 'show']);
    
    // Routes untuk Capture Fisheries Production
    Route::get('/capture-fisheries-production', [CaptureFisheriesProductionController::class, 'index']);
    Route::get('/capture-fisheries-production/{id}', [CaptureFisheriesProductionController::class, 'show']);

    // Routes untuk Marine Protected Areas
    Route::get('/marine-protected-areas', [MarineProtectedAreasController::class, 'index']);
    Route::get('/marine-protected-areas/{id}', [MarineProtectedAreasController::class, 'show']);

    // Routes untuk Total Fisheries Production
    Route::get('/total-fisheries-production', [TotalFisheriesProductionController::class, 'index']);
    Route::get('/total-fisheries-production/{id}', [TotalFisheriesProductionController::class, 'show']);

});

// Halaman daftar country report
Route::get('/report', function () {
    return view('pages.report'); // report.php untuk daftar negara
})->name('pages.report');

// Halaman detail report untuk tiap country
Route::get('/report/{country}', function ($country_name) {
    // Ambil data berdasarkan country_name dari tabel indikator
    $aquacultureData = AquacultureProduction::where('country_name', $country_name)->get();
    $captureFisheriesData = CaptureFisheriesProduction::where('country_name', $country_name)->get();
    $marineProtectedData = MarineProtectedAreas::where('country_name', $country_name)->get();
    $totalFisheriesData = TotalFisheriesProduction::where('country_name', $country_name)->get();

    // Kirim data ke view, termasuk country_name
    return view('pages.report-country', [
        'country' => $country_name, // Kirim country_name yang diterima dari URL
        'aquacultureData' => $aquacultureData,
        'captureFisheriesData' => $captureFisheriesData,
        'marineProtectedData' => $marineProtectedData,
        'totalFisheriesData' => $totalFisheriesData
    ]);
})->name('pages.report-country');

Route::get('/mpa/{country}', [MapController::class, 'showMPA'])->name('mpa.country');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
