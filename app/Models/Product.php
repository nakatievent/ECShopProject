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
                'brand:id,name',
                'Review:id,comment',
            ])
            ->get();

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


    // public function formatData($data)
    // {
    //     $result = [];

    //     if (!is_null($data)) {
    //         if ($data instanceof Collection && !$data->isEmpty()) {
    //             foreach ($data as &$item) {
    //                 $result[] = [
    //                     'id'          => e($item->id),
    //                     'brand_id'    => isset($item->brand_id)? e($item->brand_id): null,
    //                     'name'        => isset($item->shop->name)? e($item->shop->name): null,
    //                     'description' => isset($item->analysis_group_one_id)? e($item->analysis_group_one_id): null,
    //                     'detail'      => isset($item->analysis_group_two_id)? e($item->analysis_group_two_id): null,
    //                     'price'       => isset($item->analysisGroupOne->name)? e($item->analysisGroupOne->name): null,
    //                     'stock'       => isset($item->analysisGroupTwo->name)? e($item->analysisGroupTwo->name): null,
    //                     'sku'         => e($item->name),
    //                     'image_url'   => e($item->set_type),
    //                     'image_alt'   => isset($item->calendar_start)? $item->calendar_start->format('Y-m-d') : null,
    //                     'size'        => isset($item->calendar_end)? $item->calendar_end->format('Y-m-d') : null,
    //                     'status'      => e($item->card_type),
    //                     'discount'    => e($item->campaign_times),
    //                     'brand'       => isset($item->shop->name)? e($item->shop->name): null,
    //                     'category'    => isset($item->campaignTargets)? $item->campaignTargets->count(): 0,
    //                     'created_at'  => e($item->campaign_etc_amount),
    //                     'updated_at'  => e($item->campaign_etc_type),
    //                 ];
    //             }
    //         } else if ($data instanceof Model) {
    //             $result = [
    //                 'id'          => e($data->id),
    //                 'name'        => e($data->name),
    //                 'description' => isset($data->description)? e($data->description): null,
    //                 'detail'      => isset($data->detail)? e($data->detail): null,
    //                 'price'       => e($data->price),
    //                 'stock'       => isset($data->stock)? e($data->stock): null,
    //                 'sku'         => isset($data->sku)? e($data->sku): null,
    //                 'image_url'   => isset($data->image_url)? e($data->image_url): null,
    //                 'image_alt'   => isset($data->image_alt)? e($data->image_alt): null,
    //                 'size'        => isset($data->size)? e($data->size): null,
    //                 'status'      => isset($data->status)? e($data->status): null,
    //                 'discount'    => isset($data->discount)? e($data->discount): null,
    //                 'brand'       => isset($data->brand->name)? e($data->brand->name): null,
    //                 'category'    => isset($data->category)? e($data->category): null,
    //                 'created_at'  => isset($data->created_at)? $data->created_at: null,
    //                 'updated_at'  => isset($data->updated_at)? $data->updated_at: null,
    //             ];
    //         }
    //     }

    //     return $result;
    // }
}
