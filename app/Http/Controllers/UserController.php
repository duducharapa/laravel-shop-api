<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    
    /**
     * 
     */
    public function register(Request $request): JsonResponse {
        try {
            $request->validate([
                'name' => ['bail', 'required', 'string', 'max:50'],
                'password' => ['bail', 'required', 'string', 'max:64'],
                'email' => ['bail', 'required', 'string', 'email']
            ]);
        } catch (ValidationException $ex) {
            return $this->badRequestResponse($ex->getMessage());
        }

        $input = $request->only(['name', 'password', 'email']);
        $createdUser = new User($input);
        $saved = $createdUser->save();

        return $saved ?
            $this->createdResponse($createdUser) :
            $this->internalErrorResponse();
    }

}
