<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptureFisheriesProduction extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'capture_fisheries_production'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'country_code',
        'country_name',
        'capture_fisheries_production_2020',
        'capture_fisheries_production_2021',
        'capture_fisheries_production_2022',
    ];

    // Relasi dengan model Country
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_code', 'country_code');
    }
}
