<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository) 
    {
        $this->productRepository = $productRepository;
    }
    
    // Get All Products and Selected Product Section Start
    public function getAllProducts(int $category_id) 
    {
        $products = $this->productRepository->getAllProducts();
        return view('Product.index',  ['products' => $products , $category_id]);
    }
    public function index(Category $category)
    {
        $products = $this->productRepository->getAllProductsByCategoryID($category);
        return view('Product.index', [ 'products' => $products, 'category_id' => $category->id]);
    }
    // Get All Products and Selected Product Section End


    // Create Page and Store Product Section Start
    public function create(int $category_id)
    {
        $product = null;
        $categories = $this->productRepository->createProduct($category_id);
        return view('Product.create', ['category_id' => $category_id, 'categories' => $categories, "product" => $product]);
    }

    public function store(ProductRequest $request, ?int $category_id)
    {
        $productData = $request->validated();
        $this->productRepository->storeProduct($productData);
        return to_route('admin.category.product.getAllProducts', $category_id)->with('success' , 'Product has been created Successfully!');
    }
    // Create Page and Store Product Section End


    // Edit Page and Store Product Section Start
    public function edit(?int $category_id, Product $product)
    {
        $categories = $this->productRepository->editProduct();
        return view('Product.edit',['product' => $product , 'categories' => $categories, 'category_id' => $category_id]);
    }

    public function update(?int $category_id, ProductRequest $request, Product $product)
    {
        $newProductData = $request->validated();
        $this->productRepository->updateProduct($newProductData, $product);
        return to_route('admin.category.product.getAllProducts', $category_id)->with('success' , 'Product has been updated Successfully!');
    }
    // Edit Page and Store Product Section End

    // Delete Product Section
    public function destroy(int $category_id, Product $product)
    {
        $this->productRepository->deleteProduct($product);
        return to_route('admin.category.product.getAllProducts', $category_id)->with('success', 'Product is successfully Deleted!');
    }
}
