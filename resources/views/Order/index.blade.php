<x-layout>
    <x-navbar :links="[ 
        'Dashboard' => route('admin.dashboard') 
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
        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success w-75 mx-auto alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        <h4 class="text-center fw-bold py-1">Order Page</h4>
        {{-- Orders Table --}}
        {{-- ORDERS TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle bg-white rounded-4 overflow-hidden table-sm text-center">

                <thead class="table-light">

                    <tr>

                        <th scope="col">
                            ID
                        </th>

                        <th scope="col">
                            Customer
                        </th>

                        <th scope="col">
                            Total
                        </th>

                        <th scope="col" class="d-none d-md-table-cell">
                            Payment
                        </th>

                        <th scope="col" class="d-none d-lg-table-cell">
                            Transaction ID
                        </th>

                        <th scope="col">
                            Status
                        </th>

                        <th scope="col" class="d-none d-lg-table-cell">
                            Order Date
                        </th>

                        <th scope="col" class="text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($orders as $order)

                        <tr>

                            {{-- ORDER ID --}}
                            <th scope="row" class="fw-bold text-dark">

                                {{ $order->id }} .

                            </th>


                            {{-- CUSTOMER --}}
                            <td class="fw-semibold text-success">

                                {{ $order->user->name ?? 'Unknown User' }}

                            </td>


                            {{-- TOTAL --}}
                            <td class="text-dark">

                                {{ number_format($order->cart_total) }}

                                <span class="d-none d-md-inline">
                                    MMK
                                </span>

                            </td>


                            {{-- PAYMENT --}}
                            <td class="d-none d-md-table-cell text-dark">

                                {{ $order->payment->method ?? 'Not Chosen' }}

                            </td>


                            {{-- TRANSACTION ID --}}
                            <td class="d-none d-lg-table-cell text-dark">

                                {{ Str::limit($order->transaction_id, 15, ' ...') }}

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if ($order->status == 0)

                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                        Pending
                                    </span>

                                @elseif ($order->status == 1)

                                    <span class="badge bg-primary px-3 py-2 rounded-pill">
                                        Confirmed
                                    </span>

                                @elseif ($order->status == 2)

                                    <span class="badge bg-success px-3 py-2 rounded-pill">
                                        Delivered
                                    </span>

                                @elseif ($order->status == 3)

                                    <span class="badge bg-danger px-3 py-2 rounded-pill">
                                        Cancelled
                                    </span>

                                @endif

                            </td>


                            {{-- ORDER DATE --}}
                            <td class="d-none d-lg-table-cell text-secondary">

                                {{ $order->created_at->format('d M Y') }}

                            </td>


                            {{-- VIEW BUTTON --}}
                            <td>

                                <div class="d-flex justify-content-center">

                                    <a href="{{ route('admin.order.show', $order->id) }}"
                                        class="btn btn-outline-dark rounded-3 px-2 py-1">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-5 fw-bold text-secondary">

                                No Orders Yet!

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-between">

            {{-- Back Button --}}
            <button class="btn btn-dark mb-3" onclick="history.back()" type="button">
                <i class="fa-solid fa-arrow-left"></i> Back
            </button>

            <div class="">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-layout>