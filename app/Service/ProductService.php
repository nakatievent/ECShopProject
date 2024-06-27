<?php

namespace App\Service;

use App\Models\Review;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// use App\Http\Requests\Actives\SearchRequest;
// use App\Models\AnalysisGroup;
// use App\Models\AnalysisGroupRelationship;
// use App\Models\Shop;
// use Illuminate\Http\Request;

class ProductService extends Service
{
    private $Review;
    private $Product;
    private $Favorite;


    public function __construct(
        Product  $Product,
        Review   $Review,
        Favorite $Favorite)
    {
        $this->Review   = $Review;
        $this->Product  = $Product;
        $this->Favorite = $Favorite;
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
    public function search(string $keyword)
    {
        return $this->Product->search($keyword);
    }


    /**
     * 商品詳細の取得
     *
     * @param  mixed $id
     * @return void
     */
    public function getDetail(int $productId)
    {
        $result = null;

        try {
            $result = $this->Product->detail($productId);

            if (! is_null($result)) {
                $favoriteCount      = $this->Favorite->getCountForProduct($productId);
                $result['favorite'] = $favoriteCount;
            }
        } catch (\Exception $e) {
            // $this->log('stripeの顧客作成エラー:' . $e->getMessage());
        }

        return $result;
    }
}
