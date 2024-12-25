<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maps extends Model
{
    protected $fillable = ['country_id', 'geojson'];

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }
}
