<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class AbstractApiController extends Controller
{
    const SUCCESS = 'success';
    const ERROR = 'error';

    /***
     * @var mixed
     */
    protected $data;

    /** @var User */
    protected $user;

    public function __construct()
    {
        $this->data = new \stdClass();
        $this->user = null;
        $self       = &$this;

        $this->middleware(function ($request, $next) use ($self) {
            $self->user = auth()->user();
            // do something here

            return $next($request);
        });
    }

    protected function set($key, $data)
    {
        $this->data->{$key} = $data;
    }

    protected function setData($data)
    {
        $this->data = $data;
    }

    protected function sendResponse($status, $response = null, $code = 200)
    {
        if (\is_null($response))
            $response = &$this->data;

        return response()->json([
            'status' => self::SUCCESS,
            'data'   => $response
        ], $code);
    }

    protected function success($response = null)
    {
        return $this->sendResponse(self::SUCCESS, $response);
    }

    protected function error($errorMessage = null, $code = 400)
    {
        return response()->json([
            'status'       => self::ERROR,
            'errorMessage' => $errorMessage
        ], $code);
    }

    protected function printDT($data, $total, $filtered, $draw = 0)
    {
        $responseData                    = array();
        $responseData["recordsTotal"]    = (int)$total;
        $responseData["recordsFiltered"] = (int)$filtered;
        $responseData["data"]            = $data;
        $responseData["draw"]            = $draw;

        return response()->json($responseData, 200);
    }
}
