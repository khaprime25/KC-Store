<?php

namespace App\Interfaces;

use App\Models\Category;
use App\Models\Product;

interface ProductVariantRepositoryInterface
{
    public function getAllProductVariants();
    public function getAllProductVariantsByProduct(int $product_id);
    public function createProductVariant(?int $category_id, ?int $product_id);
    public function storeProductVariant(array $productVariantData);
    public function showProductVariant(int $productVariant_id);
    public function editProductVariant(int $productVariant_id);
    public function updateProductVariant(int $productVariant_id, array $productVariantData);
    public function deleteProductVariant(int $productVariant_id);
}
