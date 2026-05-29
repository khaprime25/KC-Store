<x-layout>
    <x-navbar :links="[ 
        'Category' => route('admin.category.index'),
        'Product' => route('admin.category.product.getAllProducts', $category_id) 
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
            'link' => route('admin.category.product.getAllProducts', $category_id),
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
    ]" />
    {{-- @dd($product) --}}
    <div class="content ">
        <x-product-form
            :category-id="$category_id"
            :categories="$categories"
            :product="$product"
        />
        <button class="btn btn-outline-dark" onclick="history.back()" type="button"><i class="fa-solid fa-arrow-left"></i> Back</button>

    </div>

</x-layout>