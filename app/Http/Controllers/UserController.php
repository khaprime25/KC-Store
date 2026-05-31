<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        return view('Shop.index', [ "categories" => $dataArray['categories'], 'products' => $dataArray['products'], 'productVariants' => $dataArray['productVariants']]);
    }

    public function shopDetails(int $productVariant_id) {
        $reviews = Review::where('productVariant_id', $productVariant_id)->latest()->get();        
        $productVariant = $this->userRepository->shopDetailsPage($productVariant_id);
        return view('Shop.show', ['productVariant' => $productVariant, 'reviews' => $reviews]);
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

    public function contact() {
        $categories = Category::all();
        return view('user.contact', ['categories' => $categories]);
    }
}
