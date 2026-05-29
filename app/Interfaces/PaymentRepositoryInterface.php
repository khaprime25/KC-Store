<?php

namespace App\Interfaces;

interface PaymentRepositoryInterface
{
    public function getAllPayments();
    public function storePayment(array $paymentData);
    public function editPayment(int $payment_id);
    public function updatePayment(array $paymentData, int $payment_id);
    public function deletePayment(int $payment_id);
}
