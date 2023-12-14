<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //roles
        DB::table('roles')->insert([
            'name' => 'Admin Utama',
        ]);
        DB::table('roles')->insert([
            'name' => 'SPV',
        ]);

        //user
        DB::table('users')->insert([
            'role_id'   =>  1,
            'uuid'      =>  Str::uuid(),
            'photo'       => 'img/product/product-1.jpg',
            'nik'       => '123456789',
            'name'       => 'Admin 1',
            'email'       => 'admin@gmail.com',
            'password'       => Hash::make('123456789'),
        ]);
    }
}
