<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest {

    /**
     * Determine if the current user is authorized to proceed with this request.
     * 
     * @return bool
     */
    public function authorize()
    {
        return $this->user() != null;
    }

    /**
     * Returns the rules to proceed with request attempt.
     * 
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'quantity' => ['bail', 'numeric', 'min:0']
        ];
    }

}