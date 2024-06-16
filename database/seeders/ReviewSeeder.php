<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        $users = DB::table('users')->get();
        $count = DB::table('products')->count();

        for ($index = 1; $index <= $count; $index++) {
            $revies[] = [
                'product_id' => $index,
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
