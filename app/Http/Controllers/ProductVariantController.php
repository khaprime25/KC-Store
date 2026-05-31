<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductVariantRequest;
use App\Interfaces\ProductVariantRepositoryInterface;

class ProductVariantController extends Controller
{
    protected $productVariantRepository;

    public function __construct(
        ProductVariantRepositoryInterface $productVariantRepository
    ) {
        $this->productVariantRepository = $productVariantRepository;

        // Automatic policy authorization
        $this->authorizeResource(ProductVariant::class, 'productVariant');
    }

    public function getAllProductVariants()
    {
        $this->authorize('viewAny', ProductVariant::class);

        $productVariants = $this->productVariantRepository
            ->getAllProductVariants();

        return view('Product_variant.index', [
                'productVariants' => $productVariants,
                'isGlobal' => true,
            ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(int $category_id, int $product_id)
    {
        $productVariants = $this->productVariantRepository
            ->getAllProductVariantsByProduct($product_id);

        return view('Product_variant.index', [
            'productVariants' => $productVariants,
            'category_id' => $category_id,
            'product_id' => $product_id,
            'isGlobal' => false,
        ]);
    }

    public function create(?int $category_id, ?int $product_id)
    {
        $productVariant = null;

        $products = $this->productVariantRepository
            ->createProductVariant($category_id, $product_id);

        return view('Product_variant.create', [
            'category_id' => $category_id,
            'product_id' => $product_id,
            'products' => $products,
            'productVariant' => $productVariant,
        ]);
    }

    public function globalCreate()
    {
        $products = $this->productVariantRepository
            ->createProductVariant(null, null);

        return view('Product_variant.globalCreate', [
            'products' => $products,
        ]);
    }

    public function searchProducts(Request $request)
    {
        $search = $request->search;

        $products = Product::query()

            ->when($search, function ($query) use ($search) {

                $query->where('brand', 'like', "%{$search}%")
                    ->orWhere('item', 'like', "%{$search}%");

            })

            ->select(
                'id',
                'brand',
                'item',
                'category_id'
            )

            ->limit(10)

            ->get();

        return response()->json($products);
    }

    public function store(
        int $category_id,
        int $product_id,
        ProductVariantRequest $request
    ) {
        $productVariantData = $request->validated();

        // Upload Image
        if ($request->hasFile('image')) {

            $uniqueFileName =
                uniqid() .
                '_caxper_' .
                $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                public_path('images'),
                $uniqueFileName
            );

            $productVariantData['image'] = $uniqueFileName;
        }

        $this->productVariantRepository
            ->storeProductVariant($productVariantData);

        return to_route(
            'admin.category.product.productVariant.index',
            [$category_id, $productVariantData['product_id']]
        )->with(
            'success',
            'Product Variant created successfully!'
        );
    }

    public function storeGlobal(ProductVariantRequest $request)
    {
        $productVariantData = $request->validated();

        $product = Product::findOrFail(
            $productVariantData['product_id']
        );

        // Upload Image
        if ($request->hasFile('image')) {

            $uniqueFileName =
                uniqid() .
                '_caxper_' .
                $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                public_path('images'),
                $uniqueFileName
            );

            $productVariantData['image'] = $uniqueFileName;
        }

        $this->productVariantRepository
            ->storeProductVariant($productVariantData);

        return to_route(
            'admin.category.product.productVariant.index',
            [
                $product->category_id,
                $product->id
            ]
        )->with(
            'success',
            'Product Variant created successfully!'
        );
    }

    public function show(
        int $category_id,
        int $product_id,
        ProductVariant $productVariant
    ) {
        return view('Product_variant.show', [
            'productVariant' => $productVariant,
        ]);
    }

    public function edit(
        int $category_id,
        int $product_id,
        ProductVariant $productVariant
    ) {
        $products = null;

        return view('Product_variant.edit', [
            'category_id' => $productVariant->product->category_id,
            'product_id' => $productVariant->product_id,
            'products' => $products,
            'productVariant' => $productVariant,
        ]);
    }

    public function update(
        ProductVariantRequest $request,
        int $category_id,
        int $product_id,
        ProductVariant $productVariant
    ) {
        $newProductVariantData = $request->validated();

        // Update image
        if ($request->hasFile('image')) {

            // Delete old image
            if (
                !empty($productVariant->image) &&
                file_exists(public_path('images/' . $productVariant->image))
            ) {
                unlink(public_path('images/' . $productVariant->image));
            }

            // Save new image
            $uniqueFileName =
                uniqid() .
                '_caxper_' .
                $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                public_path('images'),
                $uniqueFileName
            );

            $newProductVariantData['image'] = $uniqueFileName;
        }

        $this->productVariantRepository
            ->updateProductVariant(
                $productVariant->id,
                $newProductVariantData
            );

        return to_route(
            'admin.category.product.productVariant.index',
            [$category_id, $product_id]
        )->with(
            'success',
            'Product Variant updated successfully!'
        );
    }

    public function destroy(
        int $category_id,
        int $product_id,
        ProductVariant $productVariant
    ) {
        // Delete image if exists
        if (
            !empty($productVariant->image) &&
            file_exists(public_path('images/' . $productVariant->image))
        ) {
            unlink(public_path('images/' . $productVariant->image));
        }

        $this->productVariantRepository
            ->deleteProductVariant($productVariant->id);

        return to_route(
            'admin.category.product.productVariant.index',
            [$category_id, $product_id]
        )->with(
            'success',
            'Product Variant deleted successfully!'
        );
    }
}