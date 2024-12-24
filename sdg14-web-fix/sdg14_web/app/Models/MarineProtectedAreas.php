<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarineProtectedAreas extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'marine_protected_areas'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'country_code',
        'country_name',
        'marine_protected_areas_2020',
        'marine_protected_areas_2021',
        'marine_protected_areas_2022',
    ];

    // Relasi dengan model Country
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_code', 'country_code');
    }
}
