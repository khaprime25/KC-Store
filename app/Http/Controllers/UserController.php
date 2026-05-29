<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PaymentRequest;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() {
        $dataArray = $this->userRepository->dashboardPage();
        return view('User.dashboard', [ "categories" => $dataArray['categories'], 'products' => $dataArray['products'], 'productVariants' => $dataArray['productVariants'], 'reviews' => $dataArray['reviews']]);
    }

    public function shop(?int $category_id = null, ?int $product_id = null) {
        $dataArray = $this->userRepository->shopPage($category_id, $product_id);
        return view('User.shop', [ "categories" => $dataArray['categories'], 'products' => $dataArray['products'], 'productVariants' => $dataArray['productVariants']]);
    }

    public function shopDetails(int $productVariant_id) {
        $reviews = Review::where('productVariant_id', $productVariant_id)->latest()->get();        
        $productVariant = $this->userRepository->shopDetailsPage($productVariant_id);
        return view('User.details', ['productVariant' => $productVariant, 'reviews' => $reviews]);
    }

    public function review(Request $request) {
        if (Gate::denies('is-user')) {
            abort(403, 'Unauthorized');
        }
        $reviewData = $request->validate([
            'name' => "required",
            'email' => 'required',
            'review' => 'required|string',
            'user_id' => 'required',
            'productVariant_id' => 'required'
        ],[
            "review.required" => 'Please enter your reivew for product.'
        ]);

        $this->userRepository->review($reviewData);
        return to_route('user.details', $request->productVariant_id)->with('success', 'You have submitted review Successfully!');
    }

    public function cart() {
        if (Gate::denies('is-user')) {
        abort(403, 'Unauthorized');
        }
        $payments = Payment::all();
        $cartDatas = Cart::with('productVariant.product')->where('user_id', auth()->id())->get();        
        return view('User.cart', ['cartDatas' => $cartDatas, 'payments' => $payments]);
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

    public function order() {
        $orders = Order::where('user_id', Auth::user()->id)->latest()->get();
        return view("User.order", ['orders' => $orders]);
    }

    public function orderShow($id){
        $order = Order::with([
            'items.productVariant.product'
        ])->where('user_id', Auth::id())->findOrFail($id);

        return view('User.orderDetails', compact('order'));
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
    
    public function contact() {
        $categories = Category::all();
        return view('user.contact', ['categories' => $categories]);
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
