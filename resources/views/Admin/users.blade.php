<x-layout>
    <x-navbar :links="[ 
        'Users' => route('admin.users') 
    ]" :category-id="$category_id ?? 1"/>
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
    <div class="content">
        @if (session('success'))
        <div class="alert alert-success w-75" role="alert">
            {{ session('success') }}
        </div>
        @endif
        {{-- USERS TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle bg-white rounded-4 overflow-hidden table-sm mt-4 text-center">

                <thead class="table-light">

                    <tr>

                        <th scope="col">#</th>

                        <th scope="col">
                            Role
                        </th>

                        <th scope="col">
                            Name
                        </th>

                        <th scope="col" class="d-none d-md-table-cell">
                            Email
                        </th>

                        <th scope="col" class="text-center">
                            Role
                        </th>

                        <th scope="col" class="d-none d-lg-table-cell">
                            Register Date
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($users as $user)

                        <tr>

                            {{-- USER ID --}}
                            <td class="fw-bold text-dark">

                                {{ $user->id }} .

                            </td>


                            {{-- ROLE --}}
                            <td>

                                @if ($user->role === "admin")

                                    <span class="badge bg-dark px-3 py-2 rounded-pill">

                                        Admin

                                    </span>

                                @else

                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">

                                        User

                                    </span>

                                @endif

                            </td>


                            {{-- NAME --}}
                            <td class="fw-semibold text-success">

                                {{ $user->name }}

                            </td>


                            {{-- EMAIL --}}
                            <td class="d-none d-md-table-cell text-dark">

                                {{ $user->email }}

                            </td>


                            {{-- ROLE ADJUST --}}
                            <td>

                                @if ($user->role !== "admin")

                                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                                        {{-- PROMOTE --}}
                                        <a href="{{ route('admin.users.promote', $user->id) }}"
                                            class="btn btn-outline-dark rounded-3 px-2 py-1">

                                            <i class="fa-regular fa-circle-up"></i>

                                        </a>


                                        {{-- DEMOTE --}}
                                        <a href="{{ route('admin.users.demote', $user->id) }}"
                                            class="btn btn-outline-danger rounded-3 px-2 py-1">

                                            <i class="fa-solid fa-ban"></i>

                                        </a>

                                    </div>

                                @else

                                    <span class="text-secondary small">

                                        Protected

                                    </span>

                                @endif

                            </td>


                            {{-- SINCE --}}
                            <td class="d-none d-lg-table-cell text-secondary">

                                {{ $user->created_at->diffForHumans() }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-5 fw-bold text-secondary">

                                No Users Found!

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
        <button class="btn btn-outline-dark" onclick="history.back()" type="button"><i class="fa-solid fa-arrow-left"></i> Back</button>
    </div>
</x-layout>