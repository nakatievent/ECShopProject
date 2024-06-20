<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\ResponseService;

class SearchController extends Controller
{
    private $ProductService;
    private $ResponseService;


    /**
     * __construct
     *
     * @param  mixed $ProductService
     * @param  mixed $ResponseService
     * @return void
     */
    public function __construct(ProductService $ProductService, ResponseService $ResponseService)
    {
        $this->ResponseService = $ResponseService;
        $this->ProductService  = $ProductService;
    }


    /**
     * __invoke
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request, string $keyword)
    {
        return $this->ResponseService->success(
            [
                'data' => $this->ProductService->search($keyword),
            ],
            $request->header('Accept')
        );
    }
}
