<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::create([
            'nama_user' => 'Administrator',
            'username'  => 'admin',
            'password'  => 'admin123',
            'level'     => 'admin',
            'status'    => 'aktif',
       ]);

       User::create([
            'nama_user' => 'Kasir 1',
            'username'  => 'kasir',
            'password'  => 'kasir123',
            'level'     => 'kasir',
            'status'    => 'aktif',
       ]);

    }
}
