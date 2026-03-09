<?php

namespace Database\Seeders;

use App\Models\akun;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $akun = akun::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Administrator',
            'umur' => 25,
            'jk' => 'L',
            'akun_id' => $akun->id,
        ]);
    }
}
