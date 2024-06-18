<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products        = [];
        $bulkInsertCount = 100;

        for ($index = 1; $index <= 100; $index++) {
            $products[] = [
                'name'          => '商品' . $index,
                'brand_id'      => rand(1, 10),
                'review_id'     => rand(1, 10),
                'description'   => '商品' . $index . 'の説明',
                'detail'        => '商品' . $index . 'の詳細',
                'price'         => round(rand(100, 10000), -2),
                'stock'         => rand(0, 100),
                'sku'           => 'SKU' . $index,
                'image_url'     => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
                'image_alt'     => '商品' . $index . 'のalt属性の説明',
                'size'          => null,
                'status'        => true,
                'discount'      => rand(0, 50) / 10,
                'reviews_count' => rand(0, 100),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];

            // バルクインサート
            if ($index % $bulkInsertCount === 0) {
                DB::table('products')->insert($products);
                $products = []; // インサート後に配列をリセット
            }
        }

        // 残りのレコードを登録
        if (!empty($products)) {
            DB::table('products')->insert($products);
        }
    }
}
