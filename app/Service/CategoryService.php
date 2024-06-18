<?php

namespace App\Service;

use App\Models\Category;


class CategoryService extends Service
{
    private $Category;


    public function __construct(Category $Category)
    {
        $this->Category = $Category;
    }


    public function getProductListInCategory(int $categoryId)
    {
        return $this->Category->getProductListInCategory($categoryId);
    }


    public function getCategoryList()
    {
        return $this->Category->getCategoryList();
    }


}
