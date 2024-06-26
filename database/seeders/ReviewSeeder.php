<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $revies = [];

        $users      = DB::table('users')->get();
        $productIds = DB::table('products')->pluck('id')->toArray();

        for ($index = 1; $index <= 1000; $index++) {
            $revies[] = [
                'product_id' => $productIds[array_rand($productIds)],
                'user_id'    => $users->random()->id,
                'comment'    => 'レビュー' . $index . 'の説明',
                'rating'     => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('reviews')->insert($revies);
    }
}
