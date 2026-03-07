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
    // public function store(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $user = User::create([
    //             'nama' => $request->Data_diri->nama,
    //             'umur' => $request->Data_diri->umur,
    //             'jk' => $request->Data_diri->jenis_kelamin,
    //             'institusi' => $request->Data_diri->institusi,
    //             'panjang_tungkai' => $request->Data_diri->panjang_tungkai,
    //             'keterangan' => $request->Data_diri->keterangan,
    //             'akun_id' => null,
    //         ]);

    //         $tes = tes::create([
    //             'tanggal_tes' => $request->tanggal,
    //             'a_ka' => $request->kanan[0],
    //             'a_ki' => $request->kiri[0],
    //             'user_id' => $user->id,
    //         ]);

    //         data_kanan::create([
    //             'a1' => $request->kanan[0],
    //             'a2' => $request->kanan[1],
    //             'a3' => $request->kanan[2],
    //             'am1' => $request->kanan[3],
    //             'am2' => $request->kanan[4],
    //             'am3' => $request->kanan[5],
    //             'm1' => $request->kanan[6],
    //             'm2' => $request->kanan[7],
    //             'm3' => $request->kanan[8],
    //             'pm1' => $request->kanan[9],
    //             'pm2' => $request->kanan[10],
    //             'pm3' => $request->kanan[11],
    //             'p1' => $request->kanan[12],
    //             'p2' => $request->kanan[13],
    //             'p3' => $request->kanan[14],
    //             'pl1' => $request->kanan[15],
    //             'pl2' => $request->kanan[16],
    //             'pl3' => $request->kanan[17],
    //             'l1' => $request->kanan[18],
    //             'l2' => $request->kanan[19],
    //             'l3' => $request->kanan[20],
    //             'al1' => $request->kanan[21],
    //             'al2' => $request->kanan[22],
    //             'al3' => $request->kanan[23],
    //             'tes_id' => $tes->id,
    //         ]);

    //         data_kiri::create([
    //             'a1' => $request->kiri[0],
    //             'a2' => $request->kiri[1],
    //             'a3' => $request->kiri[2],
    //             'am1' => $request->kiri[3],
    //             'am2' => $request->kiri[4],
    //             'am3' => $request->kiri[5],
    //             'm1' => $request->kiri[6],
    //             'm2' => $request->kiri[7],
    //             'm3' => $request->kiri[8],
    //             'pm1' => $request->kiri[9],
    //             'pm2' => $request->kiri[10],
    //             'pm3' => $request->kiri[11],
    //             'p1' => $request->kiri[12],
    //             'p2' => $request->kiri[13],
    //             'p3' => $request->kiri[14],
    //             'pl1' => $request->kiri[15],
    //             'pl2' => $request->kiri[16],
    //             'pl3' => $request->kiri[17],
    //             'l1' => $request->kiri[18],
    //             'l2' => $request->kiri[19],
    //             'l3' => $request->kiri[20],
    //             'al1' => $request->kiri[21],
    //             'al2' => $request->kiri[22],
    //             'al3' => $request->kiri[23],
    //             'tes_id' => $tes->id,
    //         ]);

    //         $data = $request->nilai_normalisasi;
    //         normalisasi::create([
    //             'a_ka'  => $data[0]['kanan'],
    //             'a_ki'  => $data[0]['kiri'],
    //             'am_ka' => $data[1]['kanan'],
    //             'am_ki' => $data[1]['kiri'],
    //             'm_ka'  => $data[2]['kanan'],
    //             'm_ki'  => $data[2]['kiri'],
    //             'pm_ka' => $data[3]['kanan'],
    //             'pm_ki' => $data[3]['kiri'],
    //             'p_ka'  => $data[4]['kanan'],
    //             'p_ki'  => $data[4]['kiri'],
    //             'pl_ka' => $data[5]['kanan'],
    //             'pl_ki' => $data[5]['kiri'],
    //             'l_ka'  => $data[6]['kanan'],
    //             'l_ki'  => $data[6]['kiri'],
    //             'al_ka' => $data[7]['kanan'],
    //             'al_ki' => $data[7]['kiri'],
    //             'tes_id' => $tes->id,
    //         ]);

    //         $maxKanan = $request->max_kanan;
    //         $maxKiri = $request->max_kiri;
    //         composite_score::create([
    //             'a_ka' => $maxKanan[0],
    //             'a_ki' => $maxKiri[0],
    //             'am_ka' => $maxKanan[1],
    //             'am_ki' => $maxKiri[1],
    //             'm_ka' => $maxKanan[2],
    //             'm_ki' => $maxKiri[2],
    //             'pm_ka' => $maxKanan[3],
    //             'pm_ki' => $maxKiri[3],
    //             'p_ka' => $maxKanan[4],
    //             'p_ki' => $maxKiri[4],
    //             'pl_ka' => $maxKanan[5],
    //             'pl_ki' => $maxKiri[5],
    //             'l_ka' => $maxKanan[6],
    //             'l_ki' => $maxKiri[6],
    //             'al_ka' => $maxKanan[7],
    //             'al_ki' => $maxKiri[7],
    //             'tes_id' => $tes->id,
    //         ]);

    //         DB::commit();
    //         return response()->json([
    //             'message' => 'Data berhasil disimpan',
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return response()->json([
    //             'message' => 'Data gagal disimpan',
    //         ]);
    //     }
    // }

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
            'Data_diri.panjang_tungkai' => 'required|numeric',
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
                'panjang_tungkai' => $dataDiri['panjang_tungkai'],
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
