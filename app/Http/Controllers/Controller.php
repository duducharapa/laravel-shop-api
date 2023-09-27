<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /*
        Added some functions to provide standardized responses to all controllers.
    */
    
    protected function internalErrorResponse(): JsonResponse {
        return new JsonResponse(
            ['error' => 'Internal server error'],
            JsonResponse::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    protected function notFoundResponse(string $name): JsonResponse {
        return new JsonResponse(
            ['error' => $name],
            JsonResponse::HTTP_NOT_FOUND
        );
    }

    protected function noContentResponse(): JsonResponse {
        return new JsonResponse(
            null, JsonResponse::HTTP_NO_CONTENT
        );
    }

    protected function badRequestResponse(string $message): JsonResponse {
        return new JsonResponse(
            ['error' => $message],
            JsonResponse::HTTP_BAD_REQUEST
        );
    }

    protected function createdResponse($data): JsonResponse {
        return new JsonResponse($data, JsonResponse::HTTP_CREATED);
    }

    protected function unprocessableResponse($message): JsonResponse {
        return new JsonResponse(
            ['error' => $message],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }

}
