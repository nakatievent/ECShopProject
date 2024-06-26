<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

class Faq extends Model
{
    use HasFactory;

    /**
     * Shop
     *
     * @return BelongsTo
     */
    public function Shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }


    /**
     * よくある質問とその答えを取得
     *
     * @param  mixed $id
     * @return void
     */
    public function getFaqsFromShop(int $shopId): Collection
    {
        return $this
            ->where('shop_id', $shopId)
            ->get();
    }
}
