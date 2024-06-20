<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\PaymentService;
use App\Service\ResponseService;
use Illuminate\Support\Facades\Log;

class CreateController extends Controller
{
    private $PaymentService;
    private $ResponseService;


    /**
     * __construct
     *
     * @param  mixed $ProductService
     * @param  mixed $ResponseService
     * @return void
     */
    public function __construct(PaymentService $CategoryService, ResponseService $ResponseService)
    {
        $this->ResponseService = $ResponseService;
        $this->PaymentService  = $CategoryService;
    }


    /**
     * __invoke
     *
     * @param  mixed $request
     * @param  mixed $category_id
     * @return void
     */
    public function __invoke(Request $request)
    {
        return $this->ResponseService->success(
            [
                'data' => $this->PaymentService->createPaymentIntent($request),
            ],
            $request->header('Accept')
        );
    }
}
