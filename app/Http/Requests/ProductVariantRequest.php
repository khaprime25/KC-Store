<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric|between:0,999999.99',
            'stock' => 'required|integer|min:0',
            'size' => 'required|string|max:50',
            'description' => 'required|string|min:6',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'product_id.required' => 'The product ID is required.',
            'product_id.exists' => 'The selected product does not exist in the system.',
            'price.required' => 'The price of the product is required.',
            'price.numeric' => 'The price must be a valid number.',
            'price.between' => 'The price must be a value between 0 and 999,999.99.',
            'stock.required' => 'The stock quantity is required.',
            'stock.integer' => 'The stock quantity must be a whole number.',
            'stock.min' => 'The stock quantity must be at least 0.',
            'size.required' => 'The size is required.',
            'size.string' => 'The size must be a valid string.',
            'size.max' => 'The size may not exceed 50 characters.',
            'description.required' => 'The description is required.',
        ];
    }
}
