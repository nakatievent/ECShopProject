<?php

namespace App\Service;

use App\Models\Product;
// use App\Http\Requests\Actives\SearchRequest;
// use App\Models\AnalysisGroup;
// use App\Models\AnalysisGroupRelationship;
// use App\Models\Shop;
// use Illuminate\Http\Request;
use Stripe\StripeClient;

class PaymentService extends Service
{
    // const SEARCH_ERROR_CODE = 400;

    private $Product;


    public function __construct(Product $Product)
    {
        $this->Product = $Product;
    }


    /**
     * StripeClientの初期化
     */
    public function getStripeClient(): StripeClient
    {
        // WARNING: versionを変更するとWebHookで飛んでくるリクエストデータがおかしくなるので注意
        $stripe = new StripeClient([
            "api_key"        => config('payment.platform.stripe_api_key'),
            "stripe_version" => config('payment.platform.stripe_api_version'),
        ]);

        return $stripe;
    }


    /**
     * Stripeの顧客作成
     * ※1: SOUPの新規登録時に使用するメソッド
     */
    public function createStripeCustomer(): string
    {
        $customer = null;

        try {
            $stripe = $this->getStripeClient();

            $response = $stripe->customers->create();

            $customer = json_decode($response->toJson(), true)['id'];

        } catch (\Exception $e) {
            // $this->log('stripeの顧客作成エラー:' . $e->getMessage());
            throw $e;
        }

        return $customer;
    }


    /**
     * Stripe上の決済情報の作成
     *
     * @param  mixed $request
     * @return array
     */
    public function createPaymentIntent($request, ?string $stripeConnectId = null): ?array
    // public function createPaymentIntent(CreatePaymentIntentRequest $request, ?string $stripeConnectId = null): ?array
    {
        $paymentIntent = null;

        try {
            $stripe      = $this->getStripeClient();
            $totalAmount = (int) $request['decide_price'];

            $params = [
                'amount'   => $totalAmount,
                'currency' => config('payment.currency'),
                'metadata' => [
                    'payment_type' => $request['payment_type'] ?? null,
                    // 'shop_name'    => $this->getShopName()     ?? null
                ]
            ];

            $response = $stripe->paymentIntents->create($params, [
                'stripe_account' => $stripeConnectId
            ]);

            $paymentIntent = json_decode($response->toJson(), true);

        } catch (\Exception $e) {
            // $this->log('paymentIntent作成エラー:' . $e->getMessage());
        }

        return $paymentIntent;
    }



}
