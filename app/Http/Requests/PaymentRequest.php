<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'payment_id' => 'required|exists:payments,id',
            'user_id' => 'required|exists:users,id',
            'cart_total' => 'required|numeric',
            'phone_number' => 'required|string|max:15',
            'transaction_id' => 'required|string|min:6|max:20',
            'address' => 'required|string|max:255',            
        ];
    }

    public function messages()
    {
        return [
            'transaction_id.required' => 'Please enter transaction Id for your purchase.',
            'phone_number.required' => 'Enter your phone number to Contact for Delivery!',
            'address.required' => 'Enter your delivery addrees!'
        ];
    } 
}
