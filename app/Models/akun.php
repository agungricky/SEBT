<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class akun extends Model
{
    protected $fillable = [
        'username',
        'password',
        'role',
    ];
}
