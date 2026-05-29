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

    {{-- @dd($category_id) --}}
    <div class="content">
        <x-product-variant-component :category-id="$category_id"  :product-id="$product_id" :products="$products" :productVariant="$productVariant">
        </x-product-variant-component>
    </div>
</x-layout> 