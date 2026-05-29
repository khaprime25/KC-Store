<x-layout>
    <x-navbar :links="[ 
        'Category' => route('admin.category.index') 
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
    ]" />
    <div class="content">
        @if (session('success'))
        <div class="alert alert-success w-75 mx-auto alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        {{-- Create Category Section start --}}
        <div class="my-2">
            <label class="underline_link fs-4 mb-4" for="category">Create Categories Here!</label>
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" id="category" name="name" class="form-control w-50 @error('name') is-invalid @enderror" placeholder="Enter Products' Category ( eg. Oil )">
                    @error('name')
                        <small class="text-danger font-bold">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark "><i class="fa-solid fa-plus"></i><span class="ps-2">Create</span></button>
            </form>
        </div>
        {{-- Create Category Section end --}}

        {{-- Category Table start --}}
        {{-- CATEGORY TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle bg-white rounded-4 overflow-hidden table-sm my-3 text-center">

                <thead class="table-light">

                    <tr class="py-3">

                        <th scope="col">#</th>

                        <th scope="col">
                            Categories
                        </th>

                        <th scope="col" class="d-none d-md-table-cell">
                            Description
                        </th>

                        <th scope="col" class="text-center">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($categories as $category)

                        <tr>

                            {{-- ID --}}
                            <th scope="row" class="fw-bold">

                                {{ $category->id }} .

                            </th>


                            {{-- CATEGORY NAME --}}
                            <td>

                                <a href="{{ route('admin.category.product.index', $category->id) }}"
                                    class="text-decoration-none fw-semibold text-success">

                                    {{ $category->name }}

                                </a>

                            </td>


                            {{-- DESCRIPTION --}}
                            <td class="d-none d-md-table-cell">

                                <a href="{{ route('admin.category.product.index', $category->id) }}"
                                    class="text-decoration-none text-success fw-semibold">

                                    {{ Str::limit($category->description, 40, ' ...') }}

                                </a>

                            </td>


                            {{-- ACTIONS --}}
                            <td>

                                @if ($category->id !== 1)

                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- UPDATE --}}
                                        <a href="{{ route('admin.category.edit', $category->id) }}"
                                            class="btn btn-outline-dark rounded-3 px-2 py-1">

                                            <i class="fa-solid fa-pen"></i>

                                        </a>


                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.category.destroy', $category->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-outline-danger rounded-3 px-2 py-1"
                                                    onclick="return confirm('Delete this category?')">

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="text-center py-5 fw-bold text-secondary">

                                No Categories Yet!

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
        {{-- Category Table end --}}
        <button class="btn btn-dark" onclick="history.back()" type="button"><i class="fa-solid fa-arrow-left"></i> Back</button>

    </div>

    
</x-layout>