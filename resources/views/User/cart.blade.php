<x-user-layout>

    <x-navbar :links="[ 
        'Shop' => route('user.shop'),
    ]"/>

    {{-- SUCCESS ALERT --}}
    @if (session('success'))
        <div class="modern-alert success-alert">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="main-container cart-page">

        {{-- PAGE HEADER --}}
        <div class="cart-header">
            <div>
                <h1>Your Shopping Cart</h1>
                <p>Review your items and proceed to secure checkout.</p>
            </div>

            <a href="{{ route('user.shop') }}" class="continue-shopping-btn">
                <i class="fa-solid fa-arrow-right"></i>
                Continue Shopping
            </a>
        </div>

        <div class="row g-4">

            {{-- LEFT SIDE --}}
            <div class="col-lg-8">

                <div class="modern-cart-wrapper">
                    <x-cart-table :cartDatas="$cartDatas"></x-cart-table>
                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-lg-4">

                <div class="checkout-sidebar">

                    {{-- TOTAL --}}
                    <div class="checkout-card">
                        <div class="checkout-row">
                            <span>Subtotal</span>
                            <span id="cartTotal">0 Ks</span>
                        </div>

                        <div class="checkout-row">
                            <span>Delivery</span>
                            <span>Free</span>
                        </div>

                        <div class="checkout-total">
                            <span>Total</span>
                            <span id="orderTotalPreview">0 Ks</span>
                        </div>
                    </div>

                    {{-- PAYMENT --}}
                    <div class="checkout-card mt-4">

                        <h4 class="checkout-title">
                            Payment Method
                        </h4>

                        <label for="paymentSelect" class="modern-label">
                            Choose Payment
                        </label>

                        <select id="paymentSelect" class="modern-select">
                            <option value="" selected disabled>
                                -- Choose Payment Method --
                            </option>

                            @foreach($payments as $payment)
                                <option value="{{ $payment->id }}" 
                                        data-account-name="{{ $payment->account_name }}" 
                                        data-account-number="{{ $payment->account_number }}">
                                    {{ $payment->method }}
                                </option>
                            @endforeach
                        </select>

                        <button id="proceedToPaymentBtn"
                            class="modern-checkout-btn">
                            Proceed to Checkout
                        </button>

                    </div>

                </div>

            </div>

        </div>

        {{-- PAYMENT DETAILS --}}
        <div id="paymentDetailsCard"
            class="payment-details-wrapper {{ $errors->any() ? '' : 'd-none' }} w-75 mx-auto">

            <div class="payment-details-card">

                <div class="payment-header">
                    <h2>Payment Confirmation</h2>
                    <p>Complete your payment information below.</p>
                </div>

                {{-- PAYMENT INFO --}}
                <div class="payment-info-grid">

                    <div class="payment-info-item">
                        <span>Total Amount</span>
                        <h4 id="orderTotal"></h4>
                    </div>

                    <div class="payment-info-item">
                        <span>{{ $payment->method }} Name</span>
                        <h4 id="accountName">
                            Select a payment method
                        </h4>
                    </div>

                    <div class="payment-info-item">
                        <span>{{ $payment->method }} Number</span>
                        <h4 id="accountNumber">
                            Select a payment method
                        </h4>
                    </div>

                </div>

                {{-- FORM --}}
                <form id="orderForm"
                    method="POST"
                    action="{{ route('user.order.store') }}"
                    class="modern-payment-form">

                    @csrf

                    <input type="hidden"
                        name="payment_id"
                        id="paymentMethodId">

                    <input type="hidden"
                        name="user_id"
                        value="{{ Auth::user()->id }}">

                    <input type="hidden"
                        name="cart_total"
                        id="cart_total">

                    {{-- PHONE --}}
                    <div class="modern-form-group">
                        <label>
                            Phone Number
                        </label>

                        <input type="text"
                            name="phone_number"
                            class="modern-input"
                            value="{{ old('phone_number') }}"
                            placeholder="09xxxxxxxx">

                        @error('phone_number')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- TRANSACTION --}}
                    <div class="modern-form-group">
                        <label>
                            Transaction ID
                        </label>

                        <input type="text"
                            name="transaction_id"
                            class="modern-input"
                            minlength="6"
                            maxlength="20"
                            value="{{ old('transaction_id') }}"
                            placeholder="Enter transaction id">

                        @error('transaction_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- ADDRESS --}}
                    <div class="modern-form-group">
                        <label>
                            Delivery Address
                        </label>

                        <textarea
                            name="address"
                            rows="4"
                            class="modern-textarea"
                            placeholder="Enter your delivery address">{{ old('address') }}</textarea>

                        @error('address')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                        class="confirm-order-btn">

                        <i class="fa-solid fa-bag-shopping"></i>
                        Confirm & Place Order

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-user-layout>

<script>

$(document).ready(function () {

    /* ===================================
       HELPERS
    =================================== */

    function getContainer(element) {
        return element.closest('tr, .mobile-cart-card');
    }

    function formatPrice(number) {
        return number.toLocaleString() + ' Ks';
    }

    /* ===================================
       PRODUCT TOTAL
    =================================== */

    function updateProductTotal(container) {

        const price = parseInt(
            container.find('.productPrice').data('price')
        ) || 0;

        const quantity = parseInt(
            container.find('.quantity').val()
        ) || 1;

        const total = price * quantity;

        container.find('.productTotal').text(
            formatPrice(total)
        );
    }

    /* ===================================
       CART TOTAL
    =================================== */

    function updateCartTotal() {

        let cartTotal = 0;

        let containers;

        if ($(window).width() > 768) {

            containers =
                $('.desktop-cart-table tr[data-cart-id]');

        } else {

            containers =
                $('.mobile-cart-card');
        }

        containers.each(function () {

            const container = $(this);

            const price = parseInt(
                container.find('.productPrice').data('price')
            ) || 0;

            const quantity = parseInt(
                container.find('.quantity').val()
            ) || 1;

            cartTotal += price * quantity;
        });

        const formattedTotal =
            cartTotal.toLocaleString() + ' Ks';

        $('#cartTotal').text(formattedTotal);

        $('#orderTotalPreview').text(formattedTotal);
    }

    /* ===================================
       DATABASE SYNC
    =================================== */

    function syncQuantity(container) {

        const cartId = container.data('cart-id');

        const quantity = parseInt(
            container.find('.quantity').val()
        ) || 1;

        $.post('/cart/update-quantity', {
            cart_id: cartId,
            quantity: quantity
        });
    }

    /* ===================================
       INCREASE
    =================================== */

    $(document).on('click', '.increase', function () {

        const container = getContainer($(this));

        const quantityInput = container.find('.quantity');

        let quantity = parseInt(quantityInput.val()) || 1;

        quantity++;

        quantityInput.val(quantity);

        updateProductTotal(container);

        updateCartTotal();

        syncQuantity(container);
    });

    /* ===================================
       DECREASE
    =================================== */

    $(document).on('click', '.decrease', function () {

        const container = getContainer($(this));

        const quantityInput = container.find('.quantity');

        let quantity = parseInt(quantityInput.val()) || 1;

        if (quantity > 1) {

            quantity--;

            quantityInput.val(quantity);

            updateProductTotal(container);

            updateCartTotal();

            syncQuantity(container);
        }
    });

    /* ===================================
       MANUAL INPUT
    =================================== */

    $(document).on('input', '.quantity', function () {

        const container = getContainer($(this));

        let quantity = parseInt($(this).val()) || 1;

        if (quantity < 1) {
            quantity = 1;
            $(this).val(1);
        }

        updateProductTotal(container);

        updateCartTotal();

        syncQuantity(container);
    });

    /* ===================================
       REMOVE ITEM
    =================================== */

    $(document).on('click', '.removeBtn', function () {

        const container = getContainer($(this));

        const cartId = container.data('cart-id');

        $.ajax({

            type: 'GET',

            url: '/remove/cart',

            data: {
                cartId: cartId
            },

            success: function (response) {

                if (response.message === 'success') {

                    container.remove();

                    updateCartTotal();

                } else {

                    alert('Failed to remove item.');

                }
            },

            error: function () {

                alert('Something went wrong.');

            }
        });
    });

    /* ===================================
       PAYMENT
    =================================== */

    $('#proceedToPaymentBtn').on('click', function () {

        const selectedOption =
            $('#paymentSelect option:selected');

        const totalPrice =
            $('#cartTotal')
            .text()
            .replace('Ks', '')
            .replace(/,/g, '')
            .trim();

        $('#orderTotal').text(
            $('#cartTotal').text()
        );

        $('#accountName').text(
            selectedOption.data('account-name')
            || 'Select payment'
        );

        $('#accountNumber').text(
            selectedOption.data('account-number')
            || 'Select payment'
        );

        $('#paymentMethodId').val(
            selectedOption.val()
        );

        $('#cart_total').val(totalPrice);

        $('#paymentDetailsCard')
            .removeClass('d-none');
    });

    /* ===================================
       INITIALIZE
    =================================== */

    $('.productPrice').each(function () {

        const container = getContainer($(this));

        updateProductTotal(container);
    });

    updateCartTotal();

});

</script>
