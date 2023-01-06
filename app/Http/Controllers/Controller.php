<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($response): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $response
        ]);
    }

    protected function error($response, int $status = 400): \Illuminate\Http\JsonResponse
    {
        return response('', $status)->json([
            'data' => $response
        ]);
    }
}
