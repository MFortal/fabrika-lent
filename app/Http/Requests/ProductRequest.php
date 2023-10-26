<?php

namespace App\Http\Requests;

use App\Models\StatusTypes;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'id' => 'nullable|exists:products',
            'article' => 'required|unique:products|max:255',
            'name' => 'required|min:10|max:255|regex:/^[a-zA-Z0-9].{10,}$/|unique:products',
            'status' => 'required|in:' . StatusTypes::Available() . ',' . StatusTypes::Unavailable(),
            'data' => 'nullable|json'
        ];
    }
}
