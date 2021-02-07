<?php

namespace App\Http\Controllers\Api;

use App\Models\Device;
use App\Models\User;
use App\Requests\Auth\RegisterDeviceRequest;
use App\Requests\Auth\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends AbstractApiController
{
    public function registerDevice(RegisterDeviceRequest $request)
    {
        $existing = Device::where('application_id', $request->input('application_id'))->where('uid', $request->input('uid'))->first();

        if (is_null($existing)) {
            $existing                   = new Device();
            $existing->application_id   = $request->input('application_id');
            $existing->uid              = $request->input('uid');
            $existing->language         = $request->input('language');
            $existing->operation_system = $request->input('operation_system');
            $existing->client_token     = md5(microtime(true) . $existing->uid . $existing->application_id);
            $existing->save();
        }

        $this->set('client_token', $existing->client_token);
        return $this->success();
    }

    public function registerUser(RegisterUserRequest $request)
    {
        $save             = new User();
        $save->firstname  = $request->input('firstname');
        $save->lastname   = $request->input('lastname');
        $save->email      = $request->input('email');
        $save->password   = Hash::make($request->input('password'));
        $save->user_token = md5(microtime(true) . $request->input('email'));
        $save->save();

        $device          = Device::fromHeader();
        $device->user_id = $save->id;
        $device->save();

        $this->set('user', $save);
        return $this->success();
    }

    public function currentUser()
    {
        $user = auth()->user();
        $this->set('user', $user);
        return $this->success();
    }
}
