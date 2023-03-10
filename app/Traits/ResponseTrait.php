<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseTrait
{
    /**
     * Generate success type response.
     *
     * Returns the success data and message if there is any error
     *
     * @param array $data
     * @param string $message
     * @param integer $status_code
     * @return JsonResponse
     */
    public function responseSuccess(array $data, string $message = 'Request success',  int $status_code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status_code);
    }

    /**
     * Generate Error response.
     *
     * Returns the errors' data if there is any error
     *
     * @param string $message
     * @param int $status_code
     * @return JsonResponse
     */
    public function responseError(string $message = 'Something went wrong', int $status_code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], $status_code);

    }

    /**
     * Generate validation Error response.
     *
     * Returns the error data if there is any validation error
     *
     * @param string $message
     * @param int $status_code
     * @return JsonResponse
     */
    public function validationError(string $message = 'Missing required information', int $status_code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
        ], $status_code);
    }

    /**
     * Generate Error response.
     *
     * Returns the error data if there is any unauthorized Error
     *
     * @param string $message
     * @param int $status_code
     * @return JsonResponse
     */
    public function unauthorizedError(string $message = 'unauthorized request', int $status_code = Response::HTTP_UNAUTHORIZED): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $status_code);
    }
}
