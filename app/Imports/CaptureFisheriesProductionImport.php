<?php

namespace App\Imports;

use App\Models\Countries;
use App\Models\CaptureFisheriesProduction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CaptureFisheriesProductionImport implements ToModel, WithHeadingRow
{
    /**
     * Daftar kode negara ASEAN 
     * @var array
     */
    protected $aseanCountries = [
        'BRN', 'KHM', 'IDN', 'LAO', 'MYS', 'MMR', 'PHL', 'SGP', 'THA', 'VNM'
    ];

    public function headingRow(): int
    {
        return 4; // Tentukan baris header, dalam hal ini baris 4
    }

    
    public function model(array $row)
{
    // Abaikan baris jika tidak ada country_code atau country_code tidak termasuk dalam daftar ASEAN
    if (!isset($row['country_code']) || !in_array($row['country_code'], $this->aseanCountries)) {
        return null; 
    }

    // Cari country_id berdasarkan country_code
    $country = Countries::where('country_code', $row['country_code'])->first();

    if (!$country) {
        return null; // Abaikan jika country_code tidak ditemukan di database
    }

    // Mengganti koma dengan titik, dan membulatkan angka
    if (isset($row['2020'])) {
        $row['2020'] = str_replace(',', '.', $row['2020']); // Ganti koma jadi titik
        $row['2020'] = round((float)$row['2020']); // Bulatkan angka dan ubah menjadi integer
    }

    if (isset($row['2021'])) {
        $row['2021'] = str_replace(',', '.', $row['2021']); // Ganti koma jadi titik
        $row['2021'] = round((float)$row['2021']); // Bulatkan angka dan ubah menjadi integer
    }

    if (isset($row['2022'])) {
        $row['2022'] = str_replace(',', '.', $row['2022']); // Ganti koma jadi titik
        $row['2022'] = round((float)$row['2022']); // Bulatkan angka dan ubah menjadi integer
    }

    // Menggunakan updateOrCreate untuk memperbarui atau membuat data
    CaptureFisheriesProduction::updateOrCreate(
        ['country_id' => $country->id], // Kondisi pencarian
        [
            'capture_fisheries_production_2020' => $row['2020'] ?? null,
            'capture_fisheries_production_2021' => $row['2021'] ?? null,
            'capture_fisheries_production_2022' => $row['2022'] ?? null,
        ]
    );

    return null; // Tidak perlu mengembalikan model karena data sudah ditangani oleh updateOrCreate
}
}
