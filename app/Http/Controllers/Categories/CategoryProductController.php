<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\CategoryService;
use App\Service\ResponseService;
use Illuminate\Support\Facades\Log;

class CategoryProductController extends Controller
{
    private $CategoryService;
    private $ResponseService;


    /**
     * __construct
     *
     * @param  mixed $ProductService
     * @param  mixed $ResponseService
     * @return void
     */
    public function __construct(CategoryService $CategoryService, ResponseService $ResponseService)
    {
        $this->ResponseService = $ResponseService;
        $this->CategoryService = $CategoryService;
    }


    /**
     * __invoke
     *
     * @param  mixed $request
     * @param  mixed $category_id
     * @return void
     */
    public function __invoke(Request $request, int $category_id)
    {
        return $this->ResponseService->success(
            [
                'data' => $this->CategoryService->getProductListInCategory($category_id),
            ],
            $request->header('Accept')
        );
    }
}
