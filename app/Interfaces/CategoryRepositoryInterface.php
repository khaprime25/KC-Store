<?php

namespace App\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function showCategory(Category $category);
    public function storeCategory(array $data);
    public function updateCategory(Category $category, array $data);
    public function deleteCategory(Category $category);
}