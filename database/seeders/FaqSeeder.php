<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faqs')->insert([
            [
                'shop_id'    => 1,
                'question'   => 'お問い合わせ内容1',
                'answer'     => 'お問い合わせ内容1の答え',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_id'    => 1,
                'question'   => 'お問い合わせ内容2',
                'answer'     => 'お問い合わせ内容2の答え',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_id'    => 1,
                'question'   => 'お問い合わせ内容3',
                'answer'     => 'お問い合わせ内容3の答え',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_id'    => 1,
                'question'   => 'お問い合わせ内容4',
                'answer'     => 'お問い合わせ内容4の答え',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_id'    => 1,
                'question'   => 'お問い合わせ内容5',
                'answer'     => 'お問い合わせ内容5の答え',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
