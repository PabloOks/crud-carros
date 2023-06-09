<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function success(
        ?string $message = '',
        ?array $data = []
    ) {
        $response = [];
        if ($message) $response['message'] = $message;
        if ($data) $response['data'] = $data;

        return response()->json(
            $response,
            200
        );
    }

    public function error(
        ?string $message = '',
        ?array $data = []
    ) {
        $response = [];
        if ($message) $response['message'] = $message;
        if ($data) $response['data'] = $data;

        return response()->json(
            $response,
            422
        );
    }
}
