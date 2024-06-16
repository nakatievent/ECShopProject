<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        for ($index = 1; $index <= 10; $index++) {
            $categories[] = [
                'name'        => 'カテゴリー' . $index,
                'description' => 'カテゴリー' . $index . 'の説明',
                'image_url'   => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('categories')->insert($categories);
    }
}
