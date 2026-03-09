<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class data_kanan extends Model
{
    protected $fillable = [
        'a1',
        'a2',
        'a3',
        'am1',
        'am2',
        'am3',
        'm1',
        'm2',
        'm3',
        'pm1',
        'pm2',
        'pm3',
        'p1',
        'p2',
        'p3',
        'pl1',
        'pl2',
        'pl3',
        'l1',
        'l2',
        'l3',
        'al1',
        'al2',
        'al3',
        'tes_id',
    ];

    public function tes()
    {
        return $this->belongsTo(tes::class);
    }
}
