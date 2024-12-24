<?php

namespace App\Imports;

use App\Models\MarineProtectedAreas;
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
        // Abaikan baris jika tidak ada country_code
        if (!isset($row['country_code']) || !in_array($row['country_code'], $this->aseanCountries)) {
            return null; 
        }

        // Mengganti koma dengan titik untuk tahun 2020, 2021, 2022
        $year_2020 = isset($row['2020']) ? str_replace(',', '.', $row['2020']) : null;
        $year_2021 = isset($row['2021']) ? str_replace(',', '.', $row['2021']) : null;
        $year_2022 = isset($row['2022']) ? str_replace(',', '.', $row['2022']) : null;

        return new MarineProtectedAreas([
            'country_code' => $row['country_code'],
            'country_name' => $row['country_name'],
            'year_2020'    => $year_2020 ? round($year_2020, 1) : null,
            'year_2021'    => $year_2021 ? round($year_2021, 1) : null,
            'year_2022'    => $year_2022 ? round($year_2022, 1) : null,
        ]);
    }
}
