<x-user-layout>

    <x-navbar :links="[]"/>

    {{-- SUCCESS ALERT --}}
    @if (session('success'))
        <div class="modern-alert success-alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="main-container py-5">

        {{-- PAGE HEADER --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-5">

            <div>
                <h1 class="fw-bold" style="color:#102a43;">
                    Orders History
                </h1>

                <p class="text-muted mb-0">
                    Track your recent purchases and delivery status.
                </p>
            </div>

            <a href="{{ route('user.shop') }}"
                class="secondary-btn">

                <i class="fa-solid fa-bag-shopping me-2"></i>
                Shop More

            </a>

        </div>

        {{-- ORDERS --}}
        <div class="d-flex flex-column gap-4 w-75 mx-auto">

            @foreach ($orders as $order)

                <div class="order-history-card">

                    {{-- TOP --}}
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

                        <div>
                            <h4 class="fw-bold mb-2" style="color:#102a43;">
                                Order ID : {{ $order->id }}
                            </h4>

                            <p class="text-muted mb-0">
                                {{ $order->created_at->format('j M Y | H:i') }}
                            </p>
                        </div>

                        <div class="text-end">

                            <h3 class="fw-bold mb-3" style="color:#2a9d8f;">
                                {{ number_format($order->cart_total) }} Ks
                            </h3>

                            {{-- STATUS --}}
                            @if ($order->status == 0)

                                <span class="order-badge pending-badge">
                                    <i class="fa-solid fa-clock me-1"></i>
                                    Pending
                                </span>

                            @elseif ($order->status == 1)

                                <span class="order-badge confirmed-badge">
                                    <i class="fa-solid fa-box me-1"></i>
                                    Confirmed
                                </span>

                            @elseif ($order->status == 2)

                                <span class="order-badge delivered-badge">
                                    <i class="fa-solid fa-circle-check me-1"></i>
                                    Delivered
                                </span>

                            @elseif ($order->status == 3)

                                <span class="order-badge cancelled-badge">
                                    <i class="fa-solid fa-xmark me-1"></i>
                                    Cancelled
                                </span>

                            @endif

                        </div>

                    </div>

                    {{-- INFO --}}
                    <div class="order-info-layout">

                        <div class="order-info-item">
                            <small>Transaction ID</small>
                            <h6>{{ $order->transaction_id }}</h6>
                        </div>

                        <div class="order-info-item">
                            <small>Phone Number</small>
                            <h6>
                                <i class="fa-solid fa-phone me-2"></i>
                                {{ $order->phone_number }}
                            </h6>
                        </div>

                        <div class="order-info-item">
                            <small>Address</small>
                            <h6>
                                <i class="fa-solid fa-location-dot me-2"></i>
                                {{ Str::limit($order->address, 22, '  ...') }}
                            </h6>
                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-4">

                        <a href="{{ route('user.order.show', $order->id) }}"
                            class="primary-btn">

                            <i class="fa-solid fa-eye me-2"></i>
                            View Details

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

        {{-- THANK YOU CARD --}}
        <div class="review-form-wrapper text-center mt-5">

            <div class="section-heading">

                <h2>Thank You For Choosing Us!</h2>

                <p>
                    We are delighted to serve you and ensure the best shopping experience possible.
                </p>

            </div>

            <div class="d-flex justify-content-center gap-3 flex-wrap">

                <a href="{{ route('user.shop') }}"
                    class="primary-btn">

                    Shop More

                </a>

                <a href="{{ route('user.dashboard') }}"
                    class="secondary-btn">

                    Back to Dashboard

                </a>

            </div>

        </div>

    </div>

</x-user-layout>