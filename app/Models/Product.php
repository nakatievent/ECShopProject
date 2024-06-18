<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;


    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function Brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


    public function Review(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }


    public function favoritedByUsers(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }


    /**
     * 商品一覧の取得
     *
     * @return Collection
     */
    public function getAllProducts(): Collection
    {
        return $this
            ->with([
                'Category:id,name',
                'Brand:id,name',
                'Review:id,comment',
            ])
            // ->select('id', 'name')
            ->get();

        // $products = Cache::remember('products', 60, function () {
        //     return $this
        //         ->with([
        //             'Category:id,name',
        //             'Brand:id,name',
        //             'Review:id,comment',
        //         ])
        //         // ->select('id', 'name')
        //         ->get();
        // });

        // $products = $this
        //     ->select('id', 'name')
        //     ->get();

        // $products->load([
        //     'Category:id,name',
        //     'Brand:id,name',
        //     'Review:id,comment',
        // ]);

// return $products;

        // Log::debug($products);

        // return $products;
    }


    /**
     * 商品検索
     * NOTE: 商品名以外で検索したい場合はwhereを追加して下さい
     *
     * @return Collection
     */
    public function search(string $keyword): Collection
    {
        return $this
            ->where('name', 'like', '%' . $keyword . '%')
            ->get();
    }


    /**
     * 商品詳細
     *
     * @return Collection
     */
    public function detail(int $id): Model
    {
        return $this
            ->where('id', $id)
            ->first();
    }
}
