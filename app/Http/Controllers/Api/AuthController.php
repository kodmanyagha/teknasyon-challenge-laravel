<?php

namespace App\Http\Controllers\Api;

use App\Models\Device;
use App\Requests\Auth\RegisterDeviceRequest;
use App\Requests\Auth\RegisterUserRequest;

class AuthController extends AbstractApiController
{
    public function registerDevice(RegisterDeviceRequest $request)
    {
        $this->set('inputs', $request->input());
        $existingDevice = Device::where('application_id', $request->input('application_id'))->where('uid', $request->input('uid'))->first();
        if (is_null($existingDevice)) {
            $existingDevice                   = new Device();
            $existingDevice->application_id   = $request->input('application_id');
            $existingDevice->uid              = $request->input('uid');
            $existingDevice->language         = $request->input('language');
            $existingDevice->operation_system = $request->input('operation_system');
            $existingDevice->client_token     = md5(microtime(true) . $existingDevice->uid . $existingDevice->application_id);
            $existingDevice->save();
        }
        $this->set('client_token', $existingDevice->client_token);
        return $this->success();
    }

    public function registerUser(RegisterUserRequest $request)
    {
        $this->set('inputs', $request->input());
        return $this->success();
    }

    public function currentUser()
    {
        $user = auth()->user();
        $this->set('user', $user);
        return $this->success();
    }
}
