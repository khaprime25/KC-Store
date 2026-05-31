<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use App\Http\Requests\PaymentRequest;
use App\Models\Cart;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart() {
        if (Gate::denies('is-user')) {
        abort(403, 'Unauthorized');
        }
        $payments = Payment::all();
        $cartDatas = Cart::with('productVariant.product')->where('user_id', auth()->id())->get();        
        return view('Cart.index', ['cartDatas' => $cartDatas, 'payments' => $payments]);
    }

    public function storeCart(Request $request) {
        if (Gate::denies('is-user')) {
            abort(403, 'Unauthorized');
        }
        $cartData = [
            'user_id' => $request->user_id,
            'productVariant_id' => $request->productVariant_id,
            'quantity' => $request->quantity
        ];
        Cart::create($cartData);
        return to_route('user.cart')->with('success', 'You have added items to your Cart Successfully!');
    }

    public function removeCart(Request $request) {
        if (Gate::denies('is-user')) {
            abort(403, 'Unauthorized');
        }
        Cart::where('id', $request->cartId)->delete();
        $responseStatus = [
            'message' => "success"
        ];

        return response()->json($responseStatus);
    }

    public function updateQuantity(Request $request)
    {
        $cart = Cart::where('id', $request->cart_id)->first();

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json(['success' => true]);
    }    
    
}
