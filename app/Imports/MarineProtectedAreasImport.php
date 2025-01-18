<?php 

namespace App\Imports;

use App\Models\MarineProtectedAreas;
use App\Models\Countries;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MarineProtectedAreasImport implements ToModel, WithHeadingRow
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

        // Mengganti koma dengan titik dan membulatkan angka ke 1 desimal untuk tahun 2020, 2021, 2022
        $year_2020 = isset($row['2020']) ? str_replace(',', '.', $row['2020']): null;
        $year_2021 = isset($row['2021']) ? str_replace(',', '.', $row['2021']): null;
        $year_2022 = isset($row['2022']) ? str_replace(',', '.', $row['2022']): null;

        // Menggunakan updateOrCreate untuk memperbarui atau membuat data
        MarineProtectedAreas::updateOrCreate(
            ['country_id' => $country->id], // Kondisi pencarian
            [
                'marine_protected_areas_2020' => $year_2020,
                'marine_protected_areas_2021' => $year_2021,
                'marine_protected_areas_2022' => $year_2022,
            ]
        );

        return null; // Tidak perlu mengembalikan instance model
    }
}
