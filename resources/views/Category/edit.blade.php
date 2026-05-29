<x-layout>
    <x-navbar :links="[ 
        'Category' => route('admin.category.index'),
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
            'link' => route('admin.category.product.getAllProducts', $category_id = 1),
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
    <div class="content ">
        {{-- Update Category Section start --}}
        <div class="my-2">
            <label class="underline_link fs-4 mb-4" for="category">Update Categories Here!</label>
            <form action="{{ route('admin.category.update', $category)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <input type="text" id="category" name="name" class="form-control w-50 @error('name') is-invalid @enderror" placeholder="Enter Products' Category ( eg. Oil )" value="{{ $category->name }}">
                    @error('name')
                        <small class="text-danger font-bold">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark "><i class="fa-solid fa-plus"></i><span class="ps-2">Update</span></button>
            </form>
        </div>
        {{-- Update Category Section end --}}
    </div>
    <button class="btn btn-outline-dark" onclick="history.back()" type="button"><i class="fa-solid fa-arrow-left"></i> Back</button>

</x-layout>