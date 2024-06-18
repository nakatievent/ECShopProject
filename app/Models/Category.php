<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Log;

class Category extends Model
{
    use HasFactory;

    public function products(): belongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }


    /**
     * カテゴリーに紐づく商品を取得
     *
     * @param  mixed $categoryId
     * @return Collection
     */
    public function getProductListInCategory(int $categoryId): Collection|array
    {
        $category = $this
            ->with('products')
            ->find($categoryId);

        return $category ? $category->products : [];
    }



    public function getCategoryList(): Collection
    {
        return $this
            ->select('id', 'name')
            ->get();
    }
}
