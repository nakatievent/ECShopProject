<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ReviewSeeder::class,
            PaymentSeeder::class,
            FaqSeeder::class,
            ProductCategoriesTableSeeder::class,
            FavoriteSeeder::class,
            ColorSeeder::class,
            ImageSeeder::class,
            ProductImageSeeder::class
        ]);
    }
}
