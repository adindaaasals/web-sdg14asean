<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $fillable = ['country_code', 'country_name', 'country_flag', 'geojson'];

    // Relasi dengan model AquacultureProduction
    public function aquacultureProductions()
    {
        return $this->hasMany(AquacultureProduction::class, 'country_id', 'id');
    }

    // Relasi dengan model CaptureFisheriesProduction
    public function captureFisheriesProductions()
    {
        return $this->hasMany(CaptureFisheriesProduction::class, 'country_id', 'id');
    }

    // Relasi dengan model MarineProtectedAreas
    public function marineProtectedAreas()
    {
        return $this->hasMany(MarineProtectedAreas::class, 'country_id', 'id');
    }

    // Relasi dengan model TotalFisheriesProduction
    public function totalFisheriesProductions()
    {
        return $this->hasMany(TotalFisheriesProduction::class, 'country_id', 'id');
    }
    
    protected static function booted()
    {
        parent::booted();

        static::created(function ($country) {
            // Setelah data country baru ditambahkan, tambahkan data ke aquaculture_production
            AquacultureProduction::create([
                'country_id' => $country->id,
                'aquaculture_production_2020' => null, // Nilai default atau nilai yang ditentukan
                'aquaculture_production_2021' => null, 
                'aquaculture_production_2022' => null, 
            ]);
            
            CaptureFisheriesProduction::create([
                'country_id' => $country->id,
                'capture_fisheries_production_2020' => null, 
                'capture_fisheries_production_2021' => null, 
                'capture_fisheries_production_2022' => null, 
            ]);
            
            MarineProtectedAreas::create([
                'country_id' => $country->id,
                'marine_protected_areas_2020' => null, 
                'marine_protected_areas_2021' => null, 
                'marine_protected_areas_2022' => null, 
            ]);
            
            TotalFisheriesProduction::create([
                'country_id' => $country->id,
                'total_fisheries_production_2020' => null, 
                'total_fisheries_production_2021' => null, 
                'total_fisherie_production_2022' => null, 
            ]);
        });
    }
}
