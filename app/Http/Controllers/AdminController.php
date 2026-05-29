<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $categoryCount = Category::count();
        $productCount = Product::count();
        $paymentCount = Payment::count();
        $weeklySales = Order::where('status', 2)
                        ->whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
                        ->sum('cart_total');        
        $pendingOrders = Order::where('status', 0)->count();
        $confirmedOrders = Order::where('status', 1)->count();
        $deliveredOrders = Order::where('status', 2)->count();
        return view('admin.dashboard', compact(
            'userCount',
            'categoryCount',
            'productCount',
            'paymentCount',
            'weeklySales',
            'pendingOrders',
            'confirmedOrders',
            'deliveredOrders'
        ));
    }

    public function users() {
        $users = User::all();
        return view('Admin.users', ['users' => $users]);
    }

    public function promote(int $user_id) {
        $selectedUser = User::where('id', $user_id)->first();
        $selectedUser->role = "admin" ;
        $selectedUser->save();
        return to_route('admin.users')->with('success', 'User has been promoted to Admin Successfully!');
    }
    public function demote(int $user_id) {
        $selectedUser = User::where('id', $user_id)->first();
        $selectedUser->delete();
        return to_route('admin.users')->with('success', 'User has banned Successfully!');
    }

}
        