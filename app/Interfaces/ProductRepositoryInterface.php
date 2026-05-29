<?php

namespace App\Interfaces;

use App\Models\Product;
use App\Models\Category;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getAllProductsByCategoryID(Category $category);
    public function createProduct(int $category_id);
    public function storeProduct(array $productData);
    public function editProduct();
    public function updateProduct(array $newProductData, Product $product);
    public function showProduct(Category $category, Product $product);
    public function deleteProduct(Product $product);

}
