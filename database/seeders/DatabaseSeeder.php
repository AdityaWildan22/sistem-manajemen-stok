<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'Admin',
            'divisi' => 'ADMIN',
            'username' => 'Admin',
            'password' => Hash::make('Admin'),
        ]);

        // DB::table('users')->insert([
        //     'name' => 'Aditya',
        //     'divisi' => 'SUPERVISOR',
        //     'username' => 'Aditya',
        //     'password' => Hash::make('Admin'),
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Hari',
        //     'divisi' => 'ENGINER',
        //     'username' => 'Hari',
        //     'password' => Hash::make('Admin'),
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Handi',
        //     'divisi' => 'ADMIN',
        //     'username' => 'Handi',
        //     'password' => Hash::make('Admin'),
        // ]);
    }
} 