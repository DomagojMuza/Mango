<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_items')->insert([
            'name' => Str::random(10),
            'product_id' => 1,
        ]);

        DB::table('product_items')->insert([
            'name' => Str::random(10),
            'product_id' => 1,
            'parent_id' => 1,
        ]);
    }
}
