<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Success response method
     *
     * @param string $message
     * @param array|null $data
     * @return JsonResponse
     */
    public function sendResponseAjax(string $message, $data = null): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $data
        ];

        return response()->json($response, 200);
    }

    /**
     * Return error response
     *
     * @param string $error
     * @param int $code
     * @return JsonResponse
     */
    public function sendErrorAjax(string $error, int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        return response()->json($response, $code);
    }
}
