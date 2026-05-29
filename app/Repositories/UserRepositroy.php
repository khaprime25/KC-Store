<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Review;

class UserRepositroy implements UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
 
    }

    public function dashboardPage() 
    {
        $categories = Category::all();
        $products = Product::all();
        $productVariants = ProductVariant::all();
        $reviews = Review::latest()->take(3)->get();
        return ['categories' => $categories, 'products' => $products, 'productVariants' => $productVariants, 'reviews' => $reviews];  
    }

    public function shopPage(?int $category_id, ?int $product_id)
    {
        $categories = Category::all();
        $products = $this->filterProducts($category_id, $product_id);
        $productVariants = $this->filterProductVariants($products, $category_id, $product_id); 
        $products = $products->paginate(9);
        $productVariants = $productVariants->paginate(6);
        return ['categories' => $categories , 'products' => $products, 'productVariants' => $productVariants];
    }

    public function shopDetailsPage(int $productVariant_id)
    {
        return ProductVariant::where('id', $productVariant_id)->get();
    }

    public function review(array $reviewData)
    {
        return Review::create($reviewData);
    }

    private function filterProducts(?int $category_id, ?int $product_id)
    {
        return Product::when(request('search'), function ($query) {
            $query->where('brand', 'like', '%' . request('search') . '%');
        })->when(request('category_id'), function ($query) {
            $query->orWhere('category_id', request('category_id'));
        })->when($category_id !== null && $product_id === null, function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        });
    }

    private function filterProductVariants($products, ?int $category_id, ?int $product_id)
    {
        $productIds = $products->pluck('id')->toArray();

        return ProductVariant::when(request('search'), function ($query) use ($productIds) {
            $query->whereIn('product_id', $productIds);
        })->when(request('category_id'), function ($query) use ($productIds) {
            $query->whereIn('product_id', $productIds);
        })->when(request('min_price'), function ($query) {
            $query->where('price', '>=', request('min_price'));
        })->when(request('max_price'), function ($query) {
            $query->where('price', '<=', request('max_price'));
        })->when($category_id !== null && $product_id !== null, function ($query) use ($product_id) {
            $query->where('product_id', $product_id);
        });
    }
}
