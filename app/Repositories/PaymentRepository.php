<?php

namespace App\Repositories;

use App\Interfaces\PaymentRepositoryInterface;
use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllPayments() {
        return Payment::all();
    } 
    public function storePayment(array $paymentData) {
        return Payment::create($paymentData);
    }
    public function editPayment(int $payment_id) {
        return Payment::where('id', $payment_id)->get();
    }
    public function updatePayment(array $newPaymentData, int $payment_id) {
        return Payment::where('id',$payment_id)->update($newPaymentData);
    }
    public function deletePayment(int $payment_id) {
        return Payment::where('id', $payment_id)->delete();
    }
}
