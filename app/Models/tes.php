<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tes extends Model
{
    protected $table = 'tess';

    protected $fillable = [
        'tanggal_tes',
        'a_ka',
        'a_ki',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
