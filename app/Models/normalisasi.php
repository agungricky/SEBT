<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class normalisasi extends Model
{
    protected $fillable = [
        'a_ka',
        'a_ki',
        'am_ka',
        'am_ki',
        'm_ka',
        'm_ki',
        'pm_ka',
        'pm_ki',
        'p_ka',
        'p_ki',
        'pl_ka',
        'pl_ki',
        'l_ka',
        'l_ki',
        'al_ka',
        'al_ki',
        'tes_id'
    ];

    public function tes()
    {
        return $this->belongsTo(tes::class);
    }
}
