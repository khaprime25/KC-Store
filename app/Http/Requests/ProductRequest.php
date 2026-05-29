<?php

namespace App\Http\Requests;

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
    public function rules()
    {
        return [
            'item' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'description' => 'required|string|min:10|max:1000',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'item.required' => 'The product name is required.',
            'item.string' => 'The product name must be a valid string.',
            'item.max' => 'The product name cannot be longer than 255 characters.',
            
            'brand.required' => 'The brand is required.',
            'brand.string' => 'The brand must be a valid string.',
            'brand.max' => 'The brand cannot be longer than 100 characters.',
            
            'description.required' => 'You need to fill description here',
            'description.string' => 'The product description must be a valid string.',

            'category.required' => 'Please Select Category name..'
        ];
    } 
}