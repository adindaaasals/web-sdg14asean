<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\AquacultureProductionImport;
use App\Imports\CaptureFisheriesProductionImport;
use App\Imports\MarineProtectedAreasImport;
use App\Imports\TotalFisheriesProductionImport;

use Maatwebsite\Excel\Facades\Excel;

class ImportSDGData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sdg-data {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import SDG data for the specified type';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');

        if ($type === 'aquaculture') {
            $filePath = database_path('seeders/data/AquacultureProduction.xlsx');
            
            Excel::import(new AquacultureProductionImport, $filePath);
            $this->info('Aquaculture Production Data berhasil diimpor!');

        } else if ($type === 'capture') {
            $filePath = database_path('seeders/data/CaptureFisheriesProduction.xlsx');

            Excel::import(new CaptureFisheriesProductionImport, $filePath);
            $this->info('Capture Fisheries Data berhasil diimpor!');

        } else if ($type === 'marine') {
            $filePath = database_path('seeders/data/MarineProtectedAreas.xlsx');

            Excel::import(new MarineProtectedAreasImport, $filePath);
            $this->info('Marine Protected Areas Data berhasil diimpor!');

        } else if ($type === 'total') {
            $filePath = database_path('seeders/data/TotalFisheriesProduction.xlsx');

            Excel::import(new TotalFisheriesProductionImport, $filePath);
            $this->info('Total Fisheries Production Data berhasil diimpor!');

        } else {
            $this->error('Invalid type. Use "capture", "marine", "aquaculture" or "total".');
        }

        return 0;
    }

}
