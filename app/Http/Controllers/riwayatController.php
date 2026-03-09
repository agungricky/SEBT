<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class riwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $dataUser = User::where('akun_id', null)->with('tes')->orderBy('created_at', 'desc')->get();
        $dataUser = User::where('akun_id', null)
            ->with(['tes' => function ($q) {
                $q->orderBy('tanggal_tes', 'desc');
            }])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('Riwayat', compact('dataUser'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::with('tes', 'tes.data_kanan', 'tes.data_kiri', 'tes.normalisasi', 'tes.composite_score')->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
