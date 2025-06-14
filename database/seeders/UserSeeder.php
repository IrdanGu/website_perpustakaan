<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin',
            'email' => 'irdanguntara@gmail.com',
            'password' => Hash::make('password'),
            'jenis' => 'admin',
            'alamat' => 'Jl. Raya No. 1',
            'telepon' => '08123456789',
        ]);
    }
}