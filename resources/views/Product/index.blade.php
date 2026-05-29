<x-layout>
    <x-navbar :links="[ 
        'Category' => route('admin.category.index'),
        'Product' => route('admin.category.product.getAllProducts', $category_id ?? 1) 
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
        ],[
            'icon' => 'fa-solid fa-dollar-sign',
            'link' => route('admin.payment.index'),
            'label' => 'Payment',
        ],[
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
    {{-- @dd($category_id) --}}
    <div class="content">
        @if (session('success'))
        <div class="alert alert-success w-75 mx-auto alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="mb-3 font-extrabold fs-4">
            <a href="{{ route('admin.category.product.create' , $category_id ?? 1) }}" class="underline_link">Create Product Here!</a>
        </div>
        {{-- Product Table start --}}
        {{-- PRODUCT TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle bg-white rounded-4 overflow-hidden table-sm text-center">

                <thead class="table-light">

                    <tr>

                        <th scope="col">#</th>

                        <th scope="col">
                            Category
                        </th>

                        <th scope="col">
                            Items
                        </th>

                        <th scope="col" class="d-none d-md-table-cell">
                            Brand
                        </th>

                        <th scope="col" class="text-center">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($products as $product)

                        <tr>

                            {{-- ID --}}
                            <th scope="row" class="fw-bold">

                                {{ $product->id }} .

                            </th>


                            {{-- CATEGORY --}}
                            <td>

                                <a href="{{ route('admin.category.product.productVariant.index', [

                                    $product->category_id ?? 1,
                                    $product->id ?? 1

                                ]) }}"
                                    class="text-decoration-none fw-semibold text-success">

                                    {{ $product->category->name }}

                                </a>

                            </td>


                            {{-- ITEM --}}
                            <td>

                                <a href="{{ route('admin.category.product.productVariant.index', [

                                    $product->category_id ?? 1,
                                    $product->id ?? 1

                                ]) }}"
                                    class="text-decoration-none text-dark fw-semibold">

                                    {{ Str::limit($product->item, 11, ' ...') }}

                                </a>

                            </td>


                            {{-- BRAND --}}
                            <td class="d-none d-md-table-cell">

                                <a href="{{ route('admin.category.product.productVariant.index', [

                                    $product->category_id ?? 1,
                                    $product->id ?? 1

                                ]) }}"
                                    class="text-decoration-none text-success fw-semibold">

                                    {{ Str::limit($product->brand, 20, ' ...') }}

                                </a>

                            </td>


                            {{-- ACTIONS --}}
                            <td>

                                <div class="d-flex justify-content-center gap-2">

                                    {{-- UPDATE --}}
                                    <a href="{{ route('admin.category.product.edit', [

                                        $product->category_id,
                                        'product' => $product

                                    ]) }}"
                                        class="btn btn-outline-dark rounded-3 px-2 py-1">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>


                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.category.product.destroy', [

                                        'category' => $product->category_id,
                                        'product' => $product

                                    ]) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-outline-danger rounded-3 px-2 py-1"
                                                onclick="return confirm('Delete this product?')">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center py-5 fw-bold text-secondary">

                                No Products Yet!

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
        <div class="d-flex justify-content-between">
            <div class="">
                <button class="btn btn-dark mb-2" onclick="history.back()" type="button"><i class="fa-solid fa-arrow-left"></i> Back</button>
            </div>
            <div class="">
                <span>{{ $products->links('pagination::bootstrap-5') }}</span>
            </div>    
        </div> 
    </div>
    

</x-layout>