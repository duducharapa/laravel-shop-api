<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function authenticate(LoginRequest $request): JsonResponse {
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
