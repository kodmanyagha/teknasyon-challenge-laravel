<?php

namespace App\Http\Controllers\Api;

use App\Requests\MockPurchaseCheck\ExpireCheckRequest;
use App\Requests\MockPurchaseCheck\SubscriptionCheckRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class MockPurchaseCheckController extends AbstractApiController
{
    public function subscriptionCheck(SubscriptionCheckRequest $request)
    {
        $receiptHash = Request::input('receipt');
        $lastChar    = (int)substr($receiptHash, -1);
        $status      = $lastChar % 2 == 1;

        $routeName = Route::getCurrentRoute()->getName();
        if ($routeName == 'mock.purchaseCheck.google')
            $os = 'android';
        else if ($routeName == 'mock.purchaseCheck.apple')
            $os = 'ios';
        $this->set('os', $os);

        return $this->getStatusResponse($status);
    }

    public function expireDateCheck(ExpireCheckRequest $request)
    {
        $receiptHash = Request::input('receipt');
        $lastChars   = (int)substr($receiptHash, -2);
        $status      = ($lastChars > 0) ? ($lastChars % 6 != 0) : true;

        /*********************************
         * eğer $status false ise (mock olarak rate-limit hatası döndermemiz gerekiyorsa) bu sorgunun
         * daha sonradan tekrar denenmesi durumunda yine false döner. yani bu receipt için her zaman
         * false dönmektedir. bu durumdan kaçınmak için son kez random bir status belirliyoruz.
         */
        if ($status === false) $status = (rand(0, 10) % 2) == 0;

        return $this->getStatusResponse($status);
    }

    protected function getStatusResponse(bool $status)
    {
        if ($status) {
            $this->set('status', $status);

            $now = strtotime(gmdate("Y-m-d H:i:s", time()));
            $now = strtotime("1 week", $now); // add some days or months

            $now = strtotime("-6 hours", $now); // gmt -6
            $now = date("Y-m-d H:i:s", $now);
            $this->set('expire-date', $now);
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
