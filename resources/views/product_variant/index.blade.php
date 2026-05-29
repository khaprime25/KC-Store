<x-layout>

    <x-navbar :links="[ 
        'Category' => route('admin.category.index'),
        'Product' => route('admin.category.product.getAllProducts', $category_id ?? 1),
        'Variants' => route('admin.category.product.ProductVariant.getAllProductVariants') 
    ]" />

    <x-sidebar :links="[ 
        [
            'icon' => 'fa-solid fa-display',
            'link' => route('admin.dashboard'),
            'label' => 'Dashboard',
        ],
        [
            'icon' => 'fa-solid fa-layer-group',
            'link' => route('admin.category.index'),
            'label' => 'Categories',
        ],
        [
            'icon' => 'fa-brands fa-product-hunt',
            'link' => route('admin.category.product.getAllProducts', $category_id ?? 1),
            'label' => 'Products',
        ],
        [
            'icon' => 'fa-brands fa-product-hunt',
            'link' => route('admin.category.product.ProductVariant.getAllProductVariants'),
            'label' => 'Variants',
        ],
        [
            'icon' => 'fa-solid fa-users',
            'link' => route('admin.users'),
            'label' => 'Users',
        ],
        [
            'icon' => 'fa-solid fa-dollar-sign',
            'link' => route('admin.payment.index'),
            'label' => 'Payment',
        ],
        [
            'icon' => 'fa-solid fa-clipboard',
            'link' => route('admin.order.index'),
            'label' => 'Orders',
        ],
        [
            'icon' => 'fa-solid fa-arrow-right',
            'link' => route('logout'),
            'label' => 'Logout',
        ]
    ]"/>

    <div class="content">

        {{-- SUCCESS ALERT --}}
        @if (session('success'))

            <div class="alert alert-success w-75 mx-auto alert-dismissible fade show" role="alert">

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>

            </div>

        @endif


        {{-- PAGE HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

            <h4>
                <a class="fw-bold text-success m-0" style="text-decoration:none" href="{{route('admin.category.product.ProductVariant.getAllProductVariants')}}">Product Variants</a>
            </h4>

            <a href="{{ route('admin.category.product.productVariant.create' , [

                $productVariants->isNotEmpty()
                    ? $productVariants->first()->product->category_id
                    : $category_id,

                $productVariants->isNotEmpty()
                    ? $productVariants->first()->product_id
                    : $product_id

            ]) }}"
                class="btn btn-success px-3 py-2 rounded-3 fw-semibold">

                <i class="fa-solid fa-plus me-2"></i>
                Create Variant

            </a>

        </div>


        {{-- TABLE --}}
        <div class="table-responsive">

        <table class="table table-hover align-middle bg-white rounded-4 overflow-hidden table-sm text-center">
                <thead class="table-light">

                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                        <th scope="col">Size</th>
                        <th scope="col" class="d-none d-lg-table-cell">Stock</th>
                        <th scope="col" class="text-center">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($productVariants as $productVariant)

                        <tr>

                            {{-- ID --}}
                            <th scope="row" class="fw-bold">
                                {{ $productVariant->id }} .
                            </th>


                            {{-- BRAND --}}
                            <td>

                                <a href="{{ route('admin.category.product.productVariant.show', [

                                    'category' => $productVariant->product->category_id,
                                    'product' => $productVariant->product_id,
                                    'productVariant' => $productVariant->id

                                ]) }}"
                                    class="text-decoration-none fw-semibold text-success">

                                    {{ Str::limit($productVariant->product->brand, 8, ' ...') }}

                                </a>

                            </td>


                            {{-- PRICE --}}
                            
                            <td class="fw-bold text-success">
                                <a href="{{ route('admin.category.product.productVariant.show', [

                                        'category' => $productVariant->product->category_id,
                                        'product' => $productVariant->product_id,
                                        'productVariant' => $productVariant->id

                                    ]) }}"
                                        class="text-decoration-none fw-semibold text-dark">

                                    {{ number_format($productVariant->price) }}

                                    <span class="d-none d-md-inline">
                                        MMK
                                    </span>

                                </a>

                            </td>


                            {{-- SIZE --}}
                            <td >

                                <span class="text-success fw-bold">
                                    <a href="{{ route('admin.category.product.productVariant.show', [

                                            'category' => $productVariant->product->category_id,
                                            'product' => $productVariant->product_id,
                                            'productVariant' => $productVariant->id

                                        ]) }}"
                                            class="text-decoration-none fw-semibold text-success">

                                        {{ Str::limit($productVariant->size, 10, ' ...') }}

                                    </a>

                                </span>

                            </td>


                            {{-- STOCK --}}
                            <td class="d-none d-lg-table-cell">

                                <span class="badge bg-success-subtle text-dark px-3 py-2 rounded-pill">

                                    {{ $productVariant->stock }}

                                </span>

                            </td>


                            {{-- ACTIONS --}}
                            <td>

                                <div class="d-flex justify-content-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.category.product.productVariant.edit', [

                                        $productVariant->product->category_id,
                                        $productVariant->product_id,
                                        $productVariant->id

                                    ]) }}"
                                        class="btn btn-outline-dark rounded-3 px-2 py-1">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>


                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.category.product.productVariant.destroy', [

                                        $productVariant->product->category_id,
                                        $productVariant->product_id,
                                        $productVariant->id

                                    ]) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-outline-danger rounded-3 px-2 py-1"
                                                onclick="return confirm('Delete this variant?')">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-5 fw-bold text-secondary">

                                No Product Variants Yet!

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-4">

            <button class="btn btn-dark mb-2"
                    onclick="history.back()"
                    type="button">

                <i class="fa-solid fa-arrow-left"></i>
                Back

            </button>

            <div class="overflow-auto">
                {{ $productVariants->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>

</x-layout>