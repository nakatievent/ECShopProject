<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;


    /**
     * 商品の「いいね」数を取得
     *
     * @param  mixed $productId
     * @return int
     */
    public function getCountForProduct(int $productId): int
    {
        return $this
            ->where('product_id', $productId)
            ->count();
    }
}
