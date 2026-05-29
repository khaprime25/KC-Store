<?php


namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function showCategory(Category $category)
    {
        return $category;
    }

    public function storeCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data)
    {
        return  $category->update($data);;
    }    

    public function deleteCategory(Category $category) 
    {
        $category->delete();
        return true;
    }

}
