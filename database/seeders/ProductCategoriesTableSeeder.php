<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productCategories = [];

        $productIds    = DB::table('products')->pluck('id')->toArray();
        $categoryIds   = DB::table('categories')->pluck('id')->toArray();

        foreach ($productIds as $productId) {
            // 各商品にランダムなカテゴリーを関連付ける
            $randomCategories = array_rand(array_flip($categoryIds), rand(1, 3));

            foreach ((array) $randomCategories as $categoryId) {
                $productCategories[] = [
                    'product_id'  => $productId,
                    'category_id' => $categoryId,
                ];
            }
        }

        DB::table('product_category_relations')->insert($productCategories);
    }
}
