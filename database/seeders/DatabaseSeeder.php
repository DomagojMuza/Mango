<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pricelist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(SiteSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductItemSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(PricelistSeeder::class);
    }
}
