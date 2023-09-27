<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest {

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
            'name' => ['bail', 'required', 'string', 'max:50'],
            'description' => ['bail', 'nullable', 'string', 'max:255'],
            'price' => ['bail', 'required', 'decimal:0,2', 'numeric']
        ];
    }

}