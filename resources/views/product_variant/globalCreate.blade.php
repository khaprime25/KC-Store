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
        ],
        [
            'icon' => 'fa-solid fa-arrow-right',
            'link' => route('logout'),
            'label' => 'Logout',
        ]
    ]"/>
    {{-- @dd(isset($category_id), $category_id) --}}
    <div class="content">
        <label class="mb-4 underline_link fs-3">
            Create Product Variant (Global Search)
        </label>

        <form action="{{ route('admin.productVariant.storeGlobal') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            {{-- PRODUCT SEARCH --}}
            <div class="mb-4">

                <label class="form-label fw-bold">
                    Search Product
                </label>

                <input type="text"
                        id="product-search"
                        class="form-control"
                        placeholder="Type product Brand or Item...">

                <div id="search-results"
                    class="border rounded mt-2 bg-white">
                </div>

                <input type="hidden"
                        name="product_id"
                        id="selected-product-id"
                        value="{{ old('product_id') }}">

                @error('product_id')
                    <small class="text-danger fw-bold">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            {{-- SELECTED PRODUCT --}}
            <div id="selected-product-preview"
                class="alert alert-success d-none">
            </div>

            {{-- IMAGE --}}
            <div class="row">

                <div class="col-12 col-md-6 mb-3">

                    <input type="file"
                            id="image"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror">

                    @error('image')
                        <small class="text-danger fw-bold">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                {{-- PRICE --}}
                <div class="col-12 col-md-6 mb-3">

                    <input type="number"
                            id="price"
                            name="price"
                            class="form-control @error('price') is-invalid @enderror"
                            placeholder="Enter Product Price"
                            value="{{ old('price') }}">

                    @error('price')
                        <small class="text-danger fw-bold">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                {{-- SIZE --}}
                <div class="col-12 col-md-6 mb-3">

                    <input type="text"
                            id="size"
                            name="size"
                            class="form-control @error('size') is-invalid @enderror"
                            placeholder="Enter Size"
                            value="{{ old('size') }}">

                    @error('size')
                        <small class="text-danger fw-bold">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                {{-- STOCK --}}
                <div class="col-12 col-md-6 mb-3">

                    <input type="number"
                            id="stock"
                            name="stock"
                            class="form-control @error('stock') is-invalid @enderror"
                            placeholder="Enter Stock"
                            value="{{ old('stock') }}">

                    @error('stock')
                        <small class="text-danger fw-bold">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                {{-- DESCRIPTION --}}
                <div class="col-12 col-md-6 mb-3">

                    <textarea name="description"
                            id="description"
                            rows="3"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Enter Description">{{ old('description') }}</textarea>

                    @error('description')
                        <small class="text-danger fw-bold">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

            </div>

            {{-- BUTTONS --}}
            <div class="d-flex align-items-center gap-3 mt-3 flex-wrap">

                <button class="btn btn-outline-dark"
                        onclick="history.back()"
                        type="button">

                    <i class="fa-solid fa-arrow-left"></i>
                    Back

                </button>

                <button type="submit"
                        class="btn btn-dark">

                    <i class="fa-solid fa-plus"></i>

                    <span class="ps-2">
                        Create
                    </span>

                </button>

            </div>

        </form>

        <script>

        const searchUrl = "{{ route('admin.productVariant.searchProducts') }}";

        const searchInput = document.getElementById('product-search');
        const resultsBox = document.getElementById('search-results');
        const selectedProductId = document.getElementById('selected-product-id');
        const selectedProductPreview = document.getElementById('selected-product-preview');

        searchInput.addEventListener('keyup', async function () {

            const search = this.value.trim();

            if (search.length < 2) {

                resultsBox.innerHTML = '';
                return;

            }

            try {

                const response = await fetch(
                    `${searchUrl}?search=${encodeURIComponent(search)}`
                );

                const products = await response.json();

                resultsBox.innerHTML = '';

                if (products.length === 0) {

                    resultsBox.innerHTML = `
                        <div class="p-2 text-muted">
                            No products found.
                        </div>
                    `;

                    return;

                }

                products.forEach(product => {

                    resultsBox.innerHTML += `
                        <div
                            class="search-product-item p-2 border-bottom"
                            data-id="${product.id}"
                            data-brand="${product.brand}"
                            data-item="${product.item}">

                            <strong>${product.brand}</strong>

                            <small class="text-muted">
                                (${product.item})
                            </small>

                        </div>
                    `;

                });

            } catch (error) {

                console.error('Search Error:', error);

                resultsBox.innerHTML = `
                    <div class="p-2 text-danger">
                        Failed to load products.
                    </div>
                `;

            }

        });

        document.addEventListener('click', function (event) {

            const productItem = event.target.closest('.search-product-item');

            if (!productItem) {
                return;
            }

            selectedProductId.value = productItem.dataset.id;

            searchInput.value = productItem.dataset.brand;

            selectedProductPreview.classList.remove('d-none');

            selectedProductPreview.innerHTML = `
                <strong>Selected Product:</strong>
                ${productItem.dataset.brand}
                (${productItem.dataset.item})
            `;

            resultsBox.innerHTML = '';

        });

        </script>
    </div>
</x-layout>