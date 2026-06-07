<?php

namespace App\Http\Controllers;
use App\Interfaces\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentRepository;
    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $selectedPayment = null;
        $payments = $this->paymentRepository->getAllPayments();
        return view('Payment.index', [ 'payments' => $payments, 'selectedPayment' => $selectedPayment]);
    }

    public function store(Request $request)
    {
        $paymentData  = $request->validate([
            'method' => "required",
            'account_number' => 'required',
            'account_name' => 'required'
        ],[
            'method.required' => "Payment method name is required",
            'account_name.required' => "Payment account name is required",
            'account_number.required' => "Payment number is required",
        ]);
        $this->paymentRepository->storePayment($paymentData);
        return to_route('admin.payment.index')->with('success', 'Payment has been created Successfully!') ;
    }

    public function edit(int $payment_id)
    {
        $selectedPayment = $this->paymentRepository->editPayment($payment_id);
        $payments = $this->paymentRepository->getAllPayments();
        return view('Payment.index', [ 'payments' => $payments, 'selectedPayment' => $selectedPayment ]);
    }

    public function update(Request $request, int $payment_id)
    {
        $newPaymentData  = $request->validate([
            'method' => "required",
            'account_number' => 'required',
            'account_name' => 'required'
        ],[
            'method.required' => "Payment method name is required",
            'account_name.required' => "Payment account name is required",
            'account_number.required' => "Payment number is required",
        ]);
        $this->paymentRepository->updatePayment($newPaymentData, $payment_id);
        return to_route('admin.payment.index')->with('success', 'Payment has been updated Successfully!') ;
    }

    public function destroy(int $payment_id)
    {   
        $this->paymentRepository->deletePayment($payment_id);
        return to_route('admin.payment.index')->with('success', 'Payment has been deleted Successfully!');
    }
}
