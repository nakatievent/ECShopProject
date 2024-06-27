<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;


    /**
     * products
     *
     * @return BelongsTo
     */
    public function products(): BelongsTo
    {
        return $this->BelongsTo(Product::class);
    }


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
