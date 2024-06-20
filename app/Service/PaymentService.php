<?php

namespace App\Service;

use App\Models\Product;
// use App\Http\Requests\Actives\SearchRequest;
// use App\Models\AnalysisGroup;
// use App\Models\AnalysisGroupRelationship;
// use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;
use Stripe\PaymentIntent;

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
     *
     * @return StripeClient
     */
    public function getStripeClient(): StripeClient
    {
        // WARNING: versionを変更するとWebHookで飛んでくるリクエストデータがおかしくなるので注意
        $stripe = new StripeClient([
            "api_key"        => config('payment.stripe.api_key'),
            "stripe_version" => config('payment.stripe.api_version'),
        ]);

        return $stripe;
    }


    /**
     * Stripeの顧客作成
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
    public function createPaymentIntent(Request $request, ?string $stripeConnectId = null): string|bool
    // public function createPaymentIntent(CreatePaymentIntentRequest $request, ?string $stripeConnectId = null): ?array
    {
        try {
            $stripe      = $this->getStripeClient();
            $totalPrice = (int) $request['total_price'];

            $params = [
                'amount'   => $totalPrice,
                'currency' => config('payment.currency'),
                'metadata' => [
                    'test' => 'test',
                ]
            ];

            $paymentIntent = $stripe->paymentIntents->create($params);

            // 決済するのに必要な情報の返却
            if ($paymentIntent instanceof PaymentIntent && $paymentIntent->status === "requires_payment_method") {
                return $paymentIntent->client_secret;
            }

        } catch (\Exception $e) {
            Log::debug('paymentIntent作成エラー:' . $e->getMessage());
            // $this->log('paymentIntent作成エラー:' . $e->getMessage());
        }

        return false;
    }
}
