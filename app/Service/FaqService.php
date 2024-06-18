<?php

namespace App\Service;

use App\Models\Faq;
use Illuminate\Foundation\Application;

class FaqService extends Service
{
    private $Faq;

    public function __construct(Faq $Faq)
    {
        $this->Faq = $Faq;
    }


    /**
     * よくある質問とその答えを取得
     *
     * @param  mixed $id
     * @return void
     */
    public function getFaqsFromShop(int $shopId)
    {
        return $this->Faq->getFaqsFromShop($shopId);
    }


}
