<?php

namespace App\Service;

use App\Models\Product;
// use App\Http\Requests\Actives\SearchRequest;
// use App\Models\AnalysisGroup;
// use App\Models\AnalysisGroupRelationship;
// use App\Models\Shop;
// use Illuminate\Http\Request;

class ProductService extends Service
{
    // const SEARCH_ERROR_CODE = 400;

    private $Product;


    public function __construct(Product $Product)
    {
        $this->Product = $Product;
    }


    /**
     * 全商品の取得
     *
     * @return void
     */
    public function getAllProducts()
    {
        return $this->Product->getAllProducts();
    }


    /**
     * 商品検索
     *
     * @param  mixed $id
     * @return void
     */
    public function search(int $id)
    {
        return $this->Product->search($id);
    }


    /**
     * 商品詳細
     *
     * @param  mixed $id
     * @return void
     */
    public function detail(int $id)
    {
        return $this->Product->detail($id);
    }
}
