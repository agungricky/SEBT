<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cekSensorController extends Controller
{
    public function index()
    {
        return view('CekSensor');
    }
}
