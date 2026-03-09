<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tes extends Model
{
    protected $table = 'tess';

    protected $fillable = [
        'tanggal_tes',
        'institusi',
        'tungkai_kanan',
        'tungkai_kiri',
        'keterangan',
        'selisih_anterior',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function data_kiri()
    {
        return $this->hasOne(data_kiri::class);
    }

    public function data_kanan()
    {
        return $this->hasOne(data_kanan::class);
    }

    public function normalisasi()
    {
        return $this->hasOne(normalisasi::class);
    }

    public function composite_score()
    {
        return $this->hasOne(composite_score::class);
    }
}
