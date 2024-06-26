<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;


    /**
     * 商品のレビュー数を取得
     *
     * @param  mixed $productId
     * @return int
     */
    public function getReviewCountForProduct(int $productId): int
    {
        return $this
            ->where('product_id', $productId)
            ->count();
    }


}
