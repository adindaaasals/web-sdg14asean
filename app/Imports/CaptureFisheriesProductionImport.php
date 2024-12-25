<?php

namespace App\Imports;

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

        // Abaikan baris jika tidak ada country_code
        if (!isset($row['country_code']) || !in_array($row['country_code'], $this->aseanCountries)) {
            return null; 
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
        
        return new CaptureFisheriesProduction([
            'country_code' => $row['country_code'],
            'country_name' => $row['country_name'],
            'year_2020'    => $row['2020'] ?? null,
            'year_2021'    => $row['2021'] ?? null,
            'year_2022'    => $row['2022'] ?? null,
        ]);
    }
}
