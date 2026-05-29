<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\CategoryRepositoryInterface;


class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    // Category Page Section
    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();
        return view('Category.index', [ 'categories' => $categories]);
    }
    // Store Category Section
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string'        
        ],[
            'name.required' => 'Category Title cannot be empty!!'
        ]);
        $this->categoryRepository->storeCategory($validatedData);
        return to_route('admin.category.index')->with("success", "Category is successfully created!");
    }
    // Edit Category Section
    public function edit(Category $category)
    {
        return view('Category.edit', ['category' => $category]);
    }
    // Update Category Section
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string'        
        ],[
            'name.required' => 'Category Title cannot be empty!!'
        ]);
        $this->categoryRepository->updateCategory($category, $validatedData);
        return to_route('admin.category.index')->with("success", "Category is successfully updated!");
    }
    // Delete Category Section
    public function destroy(Category $category)
    {
        $this->categoryRepository->deleteCategory($category);
        return to_route('admin.category.index')->with('success', 'Category is successfully Deleted!');
    }
}
