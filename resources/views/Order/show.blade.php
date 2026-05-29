<x-layout>

    <x-navbar :links="[
        'Orders' => route('admin.order.index'),
        'Order Details' => '#'
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
    <div class="content">

        {{-- ORDER HEADER --}}
        <div class="card p-3 mb-4">
            <h4 class="fw-bolder mb-2">Order ID - {{ $order->id }}</h4>
            <p class="mb-2 d-flex">
                <strong style="width: 130px;" class="text-secondary">Customer</strong>
                <span class="me-1">:</span>
                <span class="fw-bold">{{ $order->user->name ?? 'N/A' }}</span>
            </p>
            <p class="mb-2 d-flex">
                <strong style="width: 130px;" class="text-secondary">Phone</strong>
                <span class="me-1">:</span>
                <span class="fw-bold">{{ $order->phone_number }}</span>
            </p>
            <p class="mb-2 d-flex">
                <strong style="width: 130px;" class="text-secondary">Address</strong>
                <span class="me-1">:</span>
                <span class="fw-bold">{{ $order->address }}</span>
            </p>
            <p class="mb-2 d-flex">
                <strong style="width: 130px;" class="text-secondary">Payment</strong>
                <span class="me-1">:</span>
                <span class="fw-bold">{{ $order->payment->method ?? 'N/A' }}</span>
            </p>
            <p class="mb-2 d-flex">
                <strong style="width: 130px;" class="text-secondary">Transaction ID</strong>
                <span class="me-1">:</span>
                <span class="fw-bold">{{ $order->transaction_id }}</span>
            </p>
            {{-- STATUS --}}
            <p class="mt-2 d-flex">
                <strong style="width: 130px;" class="text-secondary">Status</strong>
                <span class="me-1">:</span>
                @if($order->status == 0)
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif($order->status == 1)
                    <span class="badge bg-primary">Confirmed</span>
                @elseif($order->status == 2)
                    <span class="badge bg-success">Delivered</span>
                @elseif($order->status == 3)
                    <span class="badge bg-danger">Cancelled</span>
                @endif
            </p>
        </div>

        {{-- ORDER ITEMS --}}
        <div class="card p-3 mb-4">
            <h5 class="mb-3 fw-bolder">Order Items</h5>
            <div class="table-responsive">

                <table class="table table-hover table-sm align-middle text-center">

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Variant</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($order->items as $item)
                        @php
                            $subtotal = $item->price * $item->quantity;
                            $grandTotal += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ Str::limit($item->productVariant->product->brand ?? 'Product', 8, ' ...') }}</td>
                            <td>{{ Str::limit($item->productVariant->size ?? '-', 9, ' ...') }}</td>
                            <td>{{ number_format($item->price) }}
                                <span class="d-none d-md-inline">
                                MMK
                            </span>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($subtotal) }}
                                <span class="d-none d-md-inline">
                                MMK
                            </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <div class="text-end mt-3">
                <h5> Total: {{ number_format($grandTotal) }}
                    <span class="d-none d-md-inline">
                        MMK
                    </span>
                </h5>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="card p-3">
            <h5 class="mb-3">Actions</h5>
            <div class="d-flex gap-2">
                {{-- CONFIRM ORDER --}}
                @if($order->status == 0)
                    <form action="{{ route('admin.order.confirm', $order->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-primary">Confirm Order</button>
                    </form>

                    <form action="{{ route('admin.order.cancel', $order->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-danger">Cancel Order</button>
                    </form>
                @endif

                {{-- MARK AS DELIVERED --}}
                @if($order->status == 1)
                    <form action="{{ route('admin.order.deliver', $order->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success">Mark as Delivered</button>
                    </form>
                @endif

                {{-- NO ACTIONS --}}
                @if($order->status == 2 || $order->status == 3)
                    <span class="text-muted">
                        No actions available for this order.
                    </span>
                @endif
            </div>
        </div>
        <button class="btn btn-dark mt-3"
                onclick="history.back()">
            <i class="fa-solid fa-arrow-left"></i> Back
        </button>
    </div>
</x-layout>