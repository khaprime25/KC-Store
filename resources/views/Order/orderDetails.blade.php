<x-user-layout>

    <x-navbar :links="[
        'Shop' => route('user.shop', $category_id ?? null)
    ]" />

    <div class="container py-5 w-75">

        {{-- BACK BUTTON --}}
        <button class="secondary-btn mb-4"
                onclick="history.back()">

            <i class="fa-solid fa-arrow-left me-2"></i>
            Back

        </button>

        {{-- ORDER INFO --}}
        <div class="order-details-card mb-4">

            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

                <div>
                    <h2 class="fw-bold mb-2" style="color:#102a43;">
                        Order ID : {{ $order->id }}
                    </h2>

                    <p class="text-muted mb-0">
                        {{ $order->created_at->format('j M Y | H:i') }}
                    </p>
                </div>

                {{-- STATUS --}}
                <div>

                    @if ($order->status == 0)

                        <span class="order-status-badge pending-badge">
                            <i class="fa-solid fa-clock me-2"></i>
                            Pending
                        </span>

                    @elseif ($order->status == 1)

                        <span class="order-status-badge confirmed-badge">
                            <i class="fa-solid fa-box me-2"></i>
                            Confirmed
                        </span>

                    @elseif ($order->status == 2)

                        <span class="order-status-badge delivered-badge">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            Delivered
                        </span>

                    @elseif ($order->status == 3)

                        <span class="order-status-badge cancelled-badge">
                            <i class="fa-solid fa-xmark me-2"></i>
                            Cancelled
                        </span>

                    @endif

                </div>

            </div>

            {{-- INFO GRID --}}
            <div class="order-details-grid">

                <div class="order-detail-box">
                    <small>Name and Phone Number</small>

                    <h6>
                        {{ optional($order->user)->name ?? 'N/A' }} | {{ $order->phone_number }}

                    </h6>
                </div>

                <div class="order-detail-box">
                    <small>Payment Method</small>

                    <h6>
                        {{ optional($order->payment)->method ?? 'N/A' }}
                    </h6>
                </div>

                <div class="order-detail-box">
                    <small>Transaction ID</small>

                    <h6>
                        {{ $order->transaction_id }}
                    </h6>
                </div>

                <div class="order-detail-box full-width">
                    <small>Delivery Address</small>

                    <h6>
                        <i class="fa-solid fa-location-dot me-2"></i>
                        {{ $order->address }}
                    </h6>
                </div>

            </div>

        </div>

        {{-- ORDER ITEMS --}}
        <div class="order-details-card">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h4 class="fw-bold mb-0" style="color:#102a43;">
                    Order Items
                </h4>

                <div class="fw-bold" style="color:#2a9d8f;">
                    {{ count($order->items) }} Items
                </div>

            </div>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead class="order-table-head">

                        <tr>
                            <th>Product</th>
                            <th>Variant</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th class="text-end">Subtotal</th>
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

                                <td class="fw-semibold">
                                    {{ $item->productVariant->product->brand ?? 'Product' }}
                                </td>

                                <td>
                                    {{ $item->productVariant->size ?? '-' }}
                                </td>

                                <td>
                                    {{ number_format($item->price) }} MMK
                                </td>

                                <td>
                                    {{ $item->quantity }}
                                </td>

                                <td class="text-end fw-bold">
                                    {{ number_format($subtotal) }} MMK
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- TOTAL --}}
            <div class="order-total-section">

                <h5>
                    Total : {{ number_format($grandTotal) }} MMK
                </h5>

            </div>

        </div>

    </div>

</x-user-layout>