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
use Illuminate\Support\Facades\File;

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

    public function profile() {
        $categories = Category::all();
        return view('user.profile', ['categories' => $categories]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:12',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {

            // Delete old image
            if (
                $user->profile_image &&
                File::exists(public_path($user->profile_image))
            ) {
                File::delete(public_path($user->profile_image));
            }

            $image = $request->file('profile_image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(
                public_path('images/profile_images'),
                $imageName
            );

            $user->profile_image = 'images/profile_images/' . $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->save();

        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }
}
