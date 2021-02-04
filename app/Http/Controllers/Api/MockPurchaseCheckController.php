<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Request;

class MockPurchaseCheckController extends AbstractApiController
{
    private function validateInput()
    {
        Request::validate([
            'receipt' => 'required|string|min:3|max:255',
        ]);
    }

    public function check()
    {
        $this->validateInput();

        $receiptHash = trim(Request::input('receipt'));
        $lastChar    = (int)substr($receiptHash, -1);
        $status      = $lastChar % 2 == 1;
        $this->set('status', $status);
        if ($status) {
            // server timezone must be set correct value for server's timezone.
            $now = strtotime(gmdate("Y-m-d H:i:s", time()));
            $now = strtotime("-6 hours", $now);
            $now = date("Y-m-d H:i:s", $now);
            $this->set('expire-date', $now);
        }

        return $this->success();
    }
}
