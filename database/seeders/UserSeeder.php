<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => 'domim1998@gmail.com',
            'password' => Hash::make('password'),
            'site_id' => 1,
        ]);
    }
}
