<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    
    public function authenticate(Request $request): JsonResponse {
        try {
            $request->validate([
                "email" => ["bail", "required", "string"],
                "password" => ["bail", "required", "string"]
            ]);
        } catch (ValidationException $ex) {
            return $this->badRequestResponse($ex->getMessage());
        }

        $correctCredentials = Auth::attempt($request->only("email", "password"));
        if (!$correctCredentials) {
            return new JsonResponse(["error" => "Email ou senha incorreto(s)"], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $token = $request->user()->createToken("API Token");
        return response()->json([
            'token' => $token->plainTextToken
        ]);
    }

}
