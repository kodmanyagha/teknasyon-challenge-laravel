<?php

namespace App\Http\Controllers\Api;

use App\Requests\Auth\RegisterDeviceRequest;

class AuthController extends AbstractApiController
{
    public function registerDevice(RegisterDeviceRequest $request)
    {
        $this->set('inputs', $request->input());
        return $this->success();
    }

    public function registerUser(RegisterDeviceRequest $request)
    {
        $this->set('inputs', $request->input());
        return $this->success();
    }

    public function currentUser(RegisterDeviceRequest $request)
    {
        $user = auth()->user();
        $this->set('user', $user);
        return $this->success();
    }
}
