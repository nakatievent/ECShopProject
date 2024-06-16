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
        $products = [];

        for ($index = 1; $index <= 500; $index++) {
            $products[] = [
                'name'          => '商品' . $index,
                'category_id'   => rand(1, 10),
                'brand_id'      => rand(1, 10),
                'review_id'     => rand(1, 10),
                'description'   => '商品' . $index . 'の説明',
                'price'         => round(rand(100, 10000), -2),
                'stock'         => rand(0, 100),
                'sku'           => 'SKU' . $index,
                'image_url'     => null,
                'size'          => null,
                'status'        => true,
                'discount'      => rand(0, 50) / 10,
                'reviews_count' => rand(0, 100),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('products')->insert($products);
    }
}
