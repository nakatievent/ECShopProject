<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favorites = [];

        $userIds    = DB::table('users')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();

        for ($index = 1; $index <= 1000; $index++) {
            $favorites[] = [
                'user_id'    => $userIds[array_rand($userIds)],
                'product_id' => $productIds[array_rand($productIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('favorites')->insert($favorites);
    }
}
