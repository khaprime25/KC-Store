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
        ],[
            'icon' => 'fa-solid fa-dollar-sign',
            'link' => route('admin.payment.index'),
            'label' => 'Payment',
        ],[
            'icon' => 'fa-solid fa-clipboard',
            'link' => route('admin.order.index'),
            'label' => 'Orders',
        ]
    ]"/>

    <div class="content">

        {{-- PAGE TITLE --}}
        <h3 class="fw-bold text-success mb-4">
            Product Variant Details
        </h3>


        {{-- DETAILS CARD --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="row g-0">

                {{-- PRODUCT IMAGE --}}
                <div class="col-md-5">

                    <img src="{{ $productVariant->image != null
                            ? asset('images/' . $productVariant->image)
                            : asset('images/store.jpg') }}"
                        alt="product variant image"
                        class="img-fluid w-100 h-100 object-fit-cover"
                        style="max-height: 520px;">

                </div>


                {{-- PRODUCT INFO --}}
                <div class="col-md-7">

                    <div class="card-body p-4">

                        {{-- PRODUCT NAME --}}
                        <h3 class="fw-bold text-success mb-4">

                            {{ $productVariant->product->brand }}

                            {{ $productVariant->product->item }}

                        </h3>


                        {{-- PRICE --}}
                        <p class="mb-3 d-flex">

                            <strong style="width: 90px;">
                                Price
                            </strong>

                            <span class="me-2">:</span>

                            <span class="fw-semibold">

                                {{ number_format($productVariant->price) }}

                                <span class="d-none d-md-inline">
                                    Ks
                                </span>

                            </span>

                        </p>


                        {{-- SIZE --}}
                        <p class="mb-3 d-flex">

                            <strong style="width: 90px;">
                                Size
                            </strong>

                            <span class="me-2">:</span>

                            <span>

                                {{ Str::limit($productVariant->size, 20, ' ...') }}

                            </span>

                        </p>


                        {{-- STOCK --}}
                        <p class="mb-3 d-flex">

                            <strong style="width: 90px;">
                                Stock
                            </strong>

                            <span class="me-2">:</span>

                            <span>

                                {{ number_format($productVariant->stock) }}

                                Pics

                            </span>

                        </p>


                        {{-- DESCRIPTION --}}
                        <div class="mt-4">

                            <h6 class="fw-bold mb-2">
                                Description
                            </h6>

                            <p class="text-secondary mb-0">

                                {{ $productVariant->product->description }}.

                                {{ $productVariant->description }}

                            </p>

                        </div>


                        {{-- BUTTON --}}
                        <div class="mt-4">

                            <a href="{{ route('admin.category.product.productVariant.index', [

                                $productVariant->product->category_id,
                                $productVariant->product_id

                            ]) }}"
                                class="btn btn-outline-dark rounded-3 px-4 py-2">

                                <i class="fa-solid fa-box me-2"></i>

                                All Variants

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- BACK BUTTON --}}
        <button class="btn btn-dark mt-4 rounded-3 px-4"
                onclick="history.back()"
                type="button">

            <i class="fa-solid fa-arrow-left"></i>

            Back

        </button>

    </div>
</x-layout>