<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TesExport implements WithMultipleSheets
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new ListSheetExport();
        $users = User::where('akun_id', null)->get();
        foreach ($users as $user) {
            $fileName = \Carbon\Carbon::parse($user->created_at)->format('Ymd_His');
            $sheets[] = new TesSheetExport($user, $fileName);
        }
        return $sheets;
    }
}
