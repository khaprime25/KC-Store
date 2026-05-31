<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Admin Side
    public function index()
    {
        $orders = Order::with('user', 'payment')->latest()->paginate(5);
        return view('Order.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::with(['user','payment','items.productVariant.product'])->findOrFail($id);
        return view('Order.show', compact('order'));
    }

    public function confirm($id)
    {
        $order = Order::with('items.productVariant')->findOrFail($id);
        if ($order->status != 0) {
            return back()->with('error', 'Only pending orders can be confirmed.');
        }
        DB::transaction(function () use ($order) {
            foreach ($order->items as $item) {
                $variant = $item->productVariant;
                $variant->stock -= $item->quantity;
                $variant->save();
            }
            $order->status = 1;
            $order->save();
        });
        return back()->with('success', 'Order confirmed successfully!');
    }

    public function deliver($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status != 1) {
            return back()->with('error', 'Only confirmed orders can be delivered.');
        }
        $order->status = 2;
        $order->save();
        return back()->with('success', 'Order marked as delivered!');
    }

    public function cancel($id)
    {
        $order = Order::with('items.productVariant')->findOrFail($id);
        if ($order->status != 0) {
            return back()->with('error', 'Only pending orders can be cancelled.');
        }
        $order->status = 3;
        $order->save();
        return back()->with('success', 'Order cancelled successfully!');
    }

    // User Side 
    public function order() {
        $orders = Order::where('user_id', Auth::user()->id)->latest()->get();
        return view("Order.order", ['orders' => $orders]);
    }

    public function orderShow($id){
        $order = Order::with([
            'items.productVariant.product'
        ])->where('user_id', Auth::id())->findOrFail($id);

        return view('Order.orderDetails', compact('order'));
    }

    public function storeOrder(PaymentRequest $request)
    {
        $userId = Auth::id();

        // 1. Get cart items
        $cartItems = Cart::where('user_id', $userId)->get();

        // 2. Create order
        $order = Order::create($request->validated());

        // 3. Create order_items (THIS WAS MISSING)
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item->productVariant_id,
                'quantity' => $item->quantity,
                'price' => $item->productVariant->price,
            ]);
        }

        // 4. Delete cart
        Cart::where('user_id', $userId)->delete();

        return to_route('user.order');
    }
}
