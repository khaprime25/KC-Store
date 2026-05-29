{{-- =========================
    DESKTOP TABLE
========================= --}}

<div class="desktop-cart-table">

    <div class="table-responsive">

        <table class="table modern-cart-table align-middle">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($cartDatas as $cartData)

                <tr id="row{{ $cartData->id }}"
                    data-cart-id="{{ $cartData->id }}">

                    {{-- NO --}}
                    <td>
                        {{ $loop->iteration }}
                    </td>

                    {{-- PRODUCT --}}
                    <td>

                        <div class="cart-product">

                            <img src="{{ asset('images/' . $cartData->productVariant->image) }}"
                                 class="cart-product-image">

                            <div>

                                <div class="fw-bold">
                                    {{ $cartData->productVariant->product->brand }}
                                </div>

                                <small class="text-muted">
                                    {{ $cartData->productVariant->product->item }}
                                </small>

                            </div>

                        </div>

                    </td>

                    {{-- PRICE --}}
                    <td class="productPrice"
                        data-price="{{ $cartData->productVariant->price }}">

                        {{ number_format($cartData->productVariant->price) }} Ks

                    </td>

                    {{-- QUANTITY --}}
                    <td>

                        <div class="quantity-wrapper">

                            <button class="qty-btn decrease">
                                -
                            </button>

                            <input type="number"
                                   class="form-control quantity"
                                   value="{{ $cartData->quantity }}"
                                   min="1">

                            <button class="qty-btn increase">
                                +
                            </button>

                        </div>

                    </td>

                    {{-- TOTAL --}}
                    <td class="productTotal">

                        {{ number_format($cartData->productVariant->price * $cartData->quantity) }} Ks

                    </td>

                    {{-- ACTION --}}
                    <td>

                        <button class="remove-btn removeBtn">
                            Remove
                        </button>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

{{-- =========================
    MOBILE CART
========================= --}}

<div class="mobile-cart">

    @foreach ($cartDatas as $cartData)

        <div class="mobile-cart-card"
            data-cart-id="{{ $cartData->id }}">

            {{-- TOP --}}
            <div class="mobile-cart-top">

                <img src="{{ asset('images/' . $cartData->productVariant->image) }}"
                    class="mobile-cart-image">

                <div>

                    <h6 class="fw-bold mb-1">
                        {{ $cartData->productVariant->product->brand }}
                    </h6>

                    <small class="text-muted">
                        {{ $cartData->productVariant->product->item }}
                    </small>

                </div>

            </div>

            {{-- IMPORTANT HIDDEN PRICE --}}
            <div class="productPrice d-none"
                data-price="{{ $cartData->productVariant->price }}">
            </div>

            {{-- QUANTITY --}}
            <div class="mobile-quantity-wrapper">

                <button class="qty-btn decrease">
                    -
                </button>

                <input type="number"
                    class="form-control quantity"
                    value="{{ $cartData->quantity }}"
                    min="1">

                <button class="qty-btn increase">
                    +
                </button>

            </div>

            {{-- TOTAL --}}
            <div class="mobile-total">

                <span>Total</span>

                <strong class="productTotal">
                    {{ number_format($cartData->productVariant->price * $cartData->quantity) }} Ks
                </strong>

            </div>

        </div>

    @endforeach

</div>