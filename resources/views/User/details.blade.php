<x-user-layout>
    <x-navbar :links="[ 
        'Home' => route('user.dashboard'),
        'Shop' => route('user.shop'),
    ]" :category-id="$category_id ?? 1"/>
    @if (session('success'))
    <div class="alert alert-success w-75 mx-auto alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="w-75 mx-auto">
        {{-- Product Details Section Start --}}
        <div class="product-details-container">

            <div class="product-gallery">

                <img src="{{ $productVariant->first()->image 
                    ? asset('images/'. $productVariant->first()->image) 
                    : asset('images/default.jpg') }}"
                    alt="product">

            </div>

            <div class="product-info">

                <span class="product-category">
                    {{ $productVariant->first()->product->category->name }}
                </span>

                <h1 class="product-title">
                    {{ $productVariant->first()->product->brand }}
                </h1>

                <div class="product-meta">

                    <span>
                        {{ $productVariant->first()->product->item }}
                    </span>

                    <span class="dot"></span>

                    <span>
                        {{ $productVariant->first()->size }}
                    </span>

                </div>

                <div class="product-price">
                    {{ number_format($productVariant->first()->price) }} Ks
                </div>

                <div class="product-stock">
                    <i class="fa-solid fa-box-open"></i>

                    {{ $productVariant->first()->stock }}
                    In Stock
                </div>

                <div class="product-description">

                    {{ $productVariant->first()->product->description }}

                    <br><br>

                    {{ $productVariant->first()->description }}

                </div>

                <form action="{{ route('user.cart.store') }}" method="POST">

                    @csrf

                    <div class="cart-section">

                        <div class="mobile-quantity-wrapper">

                            <button type="button" id="decrease" class="qty-btn decrease">
                                -
                            </button>

                            <input type="number"
                                id="quantity"
                                name="quantity"
                                value="1"
                                min="1" class="form-control quantity w-25">

                            <button type="button" id="increase" class="qty-btn increase">
                                +
                            </button>

                        </div>

                        <input type="hidden"
                            name="user_id"
                            value="{{ Auth::user()->id ?? 2 }}">

                        <input type="hidden"
                            name="productVariant_id"
                            value="{{ $productVariant->first()->id }}">

                        <button type="submit" class="ecom-search-btn mt-4 rounded-3 py-2 w-50">

                            <i class="fa-solid fa-cart-shopping me-2"></i>

                            Add To Cart

                        </button>

                    </div>

                </form>

            </div>

        </div>
        {{-- Product Details Section End --}}
        <a style="text-decoration:none" href="{{ route('user.shop') }}" class="submit-review-btn">Shop More</a>

        {{-- Review Section Start --}}
        <div class="review-form-wrapper">

            <div class="section-heading">
                <h2>Write a Review</h2>
                <p>Share your experience with this product.</p>
            </div>

            <form action="{{ route('user.review') }}" method="POST">

                @csrf

                <div class="review-input-grid">

                    <input type="text"
                        class="modern-input"
                        value="{{ Auth::user()->name ?? 'Guest User' }}"
                        disabled>

                    <input type="email"
                        class="modern-input"
                        value="{{ Auth::user()->email ?? 'guest@email.com' }}"
                        disabled>

                </div>

                <input type="hidden"
                    name="name"
                    value="{{ Auth::user()->name ?? 'Guest' }}">

                <input type="hidden"
                    name="email"
                    value="{{ Auth::user()->email ?? 'Guest Email' }}">

                <input type="hidden"
                    name="user_id"
                    value="{{ Auth::user()->id ?? 2 }}">

                <input type="hidden"
                    name="productVariant_id"
                    value="{{ $productVariant->first()->id }}">

                <textarea name="review"
                    class="modern-textarea @error('review') is-invalid @enderror"
                    placeholder="Write your review here...">{{ old('review') }}</textarea>

                @error('review')
                    <div class="text-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror

                <button class="submit-review-btn">

                    Submit Review

                </button>

            </form>

        </div>
        {{-- Review Section End --}}

        {{-- Customer Reviews Start --}}
        <div class="text-center my-4">

            <div class="section-heading">
                <h2>Customer Reviews</h2>
                <p>What customers say about this product.</p>
            </div>

            <div class="review-grid">

                @forelse ($reviews as $review)

                    <div class="modern-review-card">

                        <div class="d-flex justify-content-between">
                            <div class="px-3 link">
                                <h4>{{ $review->name }}</h4>
                            </div>
                            <div class="px-3 link">
                                <h4>{{ $review->email }}</h4>
                            </div>
                        </div>

                        <p>
                            "{{ $review->review }}"
                        </p>

                    </div>

                @empty

                    <div class="empty-review">

                        No reviews yet.
                        Be the first to review this product.

                    </div>

                @endforelse

            </div>

        </div>
        {{-- Customer Reviews End --}}



    </div>
</x-user-layout>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const decreaseBtn = document.getElementById("decrease");
        const increaseBtn = document.getElementById("increase");
        const quantityInput = document.getElementById("quantity");

        decreaseBtn.addEventListener("click", function() {
            let quantity = Number(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
            }
        });

        increaseBtn.addEventListener("click", function() {
            let quantity = Number(quantityInput.value);
            quantityInput.value = quantity + 1;
        });
    });
</script>