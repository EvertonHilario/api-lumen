<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function successResponse($message, $data = [])
    {
        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => $message,
            'data' => $data

        ];
        return response()->json($response, $response['code']);
    }

    public function errorResponse($message, $data = [])
    {

        $response = [
            'code' => 422,
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, $response['code']);
    }
}
