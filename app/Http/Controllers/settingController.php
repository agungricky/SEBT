<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class settingController extends Controller
{

    public function get()
    {
        $jeda = Cache::get('jeda_waktu', 10);

        return response()->json([
            'jeda_waktu' => $jeda
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'jeda_waktu' => 'required|numeric|min:1'
        ]);

        Cache::forever('jeda_waktu', $request->jeda_waktu);

        return response()->json([
            'status' => 'success',
            'message' => 'Jeda waktu berhasil diperbarui',
            'jeda_waktu' => $request->jeda_waktu
        ]);
    }
}
