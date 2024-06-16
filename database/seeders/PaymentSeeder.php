<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [];

        $userIds    = DB::table('users')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();

        // 100件の決済データを生成
        for ($index = 1; $index <= 1000; $index++) {
            $payments[] = [
                'user_id'           => $userIds[array_rand($userIds)],
                'product_id'        => $productIds[array_rand($productIds)],
                'stripe_payment_no' => 'stripe_' . uniqid(),
                'price'             => round(rand(100, 10000), -2),
                'status'            => 'pending',
                'transaction_id'    => 'trans_' . uniqid(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }

        // paymentsテーブルに挿入
        DB::table('payments')->insert($payments);
    }
}
