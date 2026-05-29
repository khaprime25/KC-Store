<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
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
}
