<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $fillable = ['country_code', 'country_name'];

    // Relasi dengan model AquacultureProduction
    public function aquacultureProductions()
    {
        return $this->hasMany(AquacultureProduction::class, 'country_code', 'country_code');
    }

    // Relasi dengan model CaptureFisheriesProduction
    public function captureFisheriesProductions()
    {
        return $this->hasMany(CaptureFisheriesProduction::class, 'country_code', 'country_code');
    }

    // Relasi dengan model MarineProtectedAreas
    public function marineProtectedAreas()
    {
        return $this->hasMany(MarineProtectedAreas::class, 'country_code', 'country_code');
    }

    // Relasi dengan model TotalFisheriesProduction
    public function totalFisheriesProductions()
    {
        return $this->hasMany(TotalFisheriesProduction::class, 'country_code', 'country_code');
    }

    public function map()
    {
        return $this->hasOne(Maps::class, 'country_code', 'country_code');
    }
}
