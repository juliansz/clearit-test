<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'starts_at' => 'required|date_format:Y-m-d H:i:s|before:ends_at', 
            'ends_at' => 'required|date_format:Y-m-d H:i:s|after:starts_at', 
            'classroom_name' => 'required|string'
        ];
    }
}
