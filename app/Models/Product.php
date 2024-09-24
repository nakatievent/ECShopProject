<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;


    /**
     * category
     *
     * @return belongsToMany
     */
    public function category(): belongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category_relations');
    }


    /**
     * favorite
     *
     * @return belongsToMany
     */
    public function favorite(): belongsToMany
    {
        return $this->belongsToMany(Favorite::class, 'favorites');
    }


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


    public function review(): HasMany
    {
        return $this->HasMany(Review::class);
    }


    public function image(): belongsToMany
    {
        return $this->belongsToMany(Image::class, 'product_image_relations');
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
                'image:id,image_url',
            ])
            ->get()
            ->each(function ($product) {
                $product->setRelation('image', $product->image->first());
            });

        // return DB::table('products')->get();

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
    public function detail(int $id): Model|null
    {
        return $this
            ->where('id', $id)
            ->with([
                'brand:id,name',
                'category:id,name',
                'review:id,product_id,comment',
                'image:id,image_url',
            ])
            ->first();
    }
}
