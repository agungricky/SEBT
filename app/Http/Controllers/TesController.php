<?php

namespace App\Http\Controllers;

use App\Models\composite_score;
use App\Models\data_kanan;
use App\Models\data_kiri;
use App\Models\normalisasi;
use App\Models\tes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // =============================
        // VALIDASI
        // =============================
        $request->validate([
            'Data_diri' => 'required|array',
            'Data_diri.nama' => 'required|string',
            'Data_diri.umur' => 'required|numeric',
            'Data_diri.jenis_kelamin' => 'required|string',
            'Data_diri.institusi' => 'required|string',
            'Data_diri.tungkai_kanan' => 'required|numeric',
            'Data_diri.tungkai_kiri' => 'required|numeric',
            'Data_diri.keterangan' => 'nullable|string',

            'tanggal' => 'required|date',

            'kanan' => 'required|array|size:24',
            'kiri' => 'required|array|size:24',

            'nilai_normalisasi' => 'required|array|size:8',
            'max_kanan' => 'required|array|size:8',
            'max_kiri' => 'required|array|size:8',
        ]);

        try {

            DB::beginTransaction();

            // =============================
            // USER
            // =============================
            $dataDiri = $request->input('Data_diri');

            $user = User::create([
                'nama' => $dataDiri['nama'],
                'umur' => $dataDiri['umur'],
                'jk' => $dataDiri['jenis_kelamin'],
                'institusi' => $dataDiri['institusi'],
                'tungkai_kanan' => $dataDiri['tungkai_kanan'],
                'tungkai_kiri' => $dataDiri['tungkai_kiri'],
                'keterangan' => $dataDiri['keterangan'] ?? null,
                'akun_id' => null,
            ]);

            // =============================
            // TES
            // =============================
            $tes = tes::create([
                'tanggal_tes' => Carbon::parse($request->tanggal)->format('Y-m-d H:i:s'),
                'a_ka' => $request->kanan[0],
                'a_ki' => $request->kiri[0],
                'user_id' => $user->id,
            ]);

            // =============================
            // DATA KANAN & KIRI (Looping)
            // =============================

            $labels = ['a', 'am', 'm', 'pm', 'p', 'pl', 'l', 'al'];

            $kananInsert = [];
            $kiriInsert = [];

            foreach ($labels as $i => $label) {

                for ($j = 1; $j <= 3; $j++) {

                    $index = ($i * 3) + ($j - 1);

                    $kananInsert[$label . $j] = $request->kanan[$index];
                    $kiriInsert[$label . $j] = $request->kiri[$index];
                }
            }

            $kananInsert['tes_id'] = $tes->id;
            $kiriInsert['tes_id'] = $tes->id;

            data_kanan::create($kananInsert);
            data_kiri::create($kiriInsert);

            // =============================
            // NORMALISASI
            // =============================

            $normalisasiInsert = [];
            $nilaiNormalisasi = $request->nilai_normalisasi;

            foreach ($labels as $i => $label) {
                $normalisasiInsert[$label . '_ka'] = $nilaiNormalisasi[$i]['kanan'];
                $normalisasiInsert[$label . '_ki'] = $nilaiNormalisasi[$i]['kiri'];
            }

            $normalisasiInsert['tes_id'] = $tes->id;

            normalisasi::create($normalisasiInsert);

            // =============================
            // COMPOSITE SCORE
            // =============================

            $compositeInsert = [];
            $maxKanan = $request->max_kanan;
            $maxKiri = $request->max_kiri;

            foreach ($labels as $i => $label) {
                $compositeInsert[$label . '_ka'] = $maxKanan[$i];
                $compositeInsert[$label . '_ki'] = $maxKiri[$i];
            }

            $compositeInsert['tes_id'] = $tes->id;

            composite_score::create($compositeInsert);

            DB::commit();

            return response()->json([
                'message' => 'Data berhasil disimpan',
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error($e);

            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(tes $tes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tes $tes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tes $tes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tes $tes)
    {
        //
    }
}
