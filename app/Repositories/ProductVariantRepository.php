<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductVariantRepositoryInterface;
use App\Models\ProductVariant;

class ProductVariantRepository implements ProductVariantRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllProductVariants() {
        return ProductVariant::paginate(5);
    }
    
    public function getAllProductVariantsByProduct(int $product_id)
    {
        return ProductVariant::where('product_id', $product_id)->paginate(6);
    }

    public function createProductVariant(?int $category_id, ?int $product_id) {
        if($category_id == 1 || $category_id == null && $product_id == 1 || $product_id == null) {
            $products = Product::all();
        }else {
            $products = Product::where('category_id', $category_id)->where('id', $product_id)->get();
        }
        return $products;
    }
    public function storeProductVariant(array $productVariantData) {
        return ProductVariant::create($productVariantData);
    }
    public function editProductVariant(int $productVariant_id) {
        $productVariant = ProductVariant::where('id', $productVariant_id)->get();
        return $productVariant;
    }
    public function showProductVariant(int $productVariant_id)
    {
        return ProductVariant::where('id', $productVariant_id)->get();
    }
    public function updateProductVariant(int $productVariant_id, array $newProductVariantData) {
        return ProductVariant::where('id', $productVariant_id)->update($newProductVariantData);
    }
    public function deleteProductVariant(int $productVariant_id) {
        return ProductVariant::where('id' , $productVariant_id)->delete();
    }
}
