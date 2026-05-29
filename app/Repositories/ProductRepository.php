<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllProducts() 
    {
        return Product::paginate(5);
    }

    public function getAllProductsByCategoryID(Category $category) 
    {
        return Product::where('category_id', $category->id)->get();
    }

    public function createProduct(int $category_id)
    {
        if($category_id == 1 || $category_id == null) {
            $categories = Category::all();
        }else {
            $categories = Category::where('id', $category_id)->get();
        }
        return $categories;
    }

    public function storeProduct(array $productData ) 
    {
        return Product::create($productData);
    }

    public function editProduct()
    {
        return Category::all();
    }

    public function updateProduct( array $newProductData, Product $product) {
        return $product->update($newProductData);
    }

    public function showProduct(Category $category, Product $product) {
        return ;
    }

    public function deleteProduct(Product $product) {
        return $product->delete();
    }
}
