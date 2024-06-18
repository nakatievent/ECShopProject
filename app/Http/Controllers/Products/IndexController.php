<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Service\ProductService;
use App\Service\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    private $ResponseService;
    private $ProductService;


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
    public function __invoke(Request $request)
    {
        return $this->ResponseService->success(
            [
                'data' => $this->ProductService->getAllProducts(),
            ],
            $request->header('Accept')
        );
    }
}
