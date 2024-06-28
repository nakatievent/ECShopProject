<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImages = [];

        $productIds   = DB::table('products')->pluck('id')->toArray();
        $imageIds     = DB::table('images')->pluck('id')->toArray();
        $imageIdCount = count($imageIds);

        // ランダムに商品と画像の関連を生成
        foreach ($productIds as $productId) {

            // それぞれの商品に対してランダムな画像を関連付ける
            $randomImageCount = rand(1, $imageIdCount);
            $randomImageIds   = array_rand($imageIds, $randomImageCount);

            if ($randomImageCount === 1) {
                $randomImageIds = [$randomImageIds];
            }

            foreach ($randomImageIds as $imageIndex) {
                $productImages[] = [
                    'product_id' => $productId,
                    'image_id' => $imageIds[$imageIndex],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // メモリ節約のため定期的にデータベースに挿入
            if (count($productImages) > 1000) {
                DB::table('product_image_relations')->insert($productImages);
                $productImages = [];
            }
        }

        // 残りのデータを挿入
        if (!empty($productImages)) {
            DB::table('product_image_relations')->insert($productImages);
        }
    }
}
