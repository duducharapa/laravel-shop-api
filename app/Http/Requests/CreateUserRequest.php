<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the current user is authorized to proceed with this request.
     * 
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Returns the rules to proceed with request attempt.
     * 
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:50'],
            'password' => ['bail', 'required', 'string', 'max:64'],
            'email' => ['bail', 'required', 'string', 'email']
        ];
    }
}