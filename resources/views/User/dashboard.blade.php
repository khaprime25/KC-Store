<x-user-layout>
    <x-navbar :categories="$categories"/>

    @if (session('success'))
    <div class="alert alert-success w-75 mx-auto mt-3 alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif



    {{-- HERO SECTION --}}
    <section class="hero-section">
        <div class="main-container">

            <div class="hero-wrapper">

                <div class="hero-content">
                    <span class="hero-badge">
                        🔥 Trusted KC Store
                    </span>

                    <h1>
                        Discover Everyday Products
                        With Better Quality
                    </h1>

                    <p>
                        Browse affordable goods, snacks, drinks,
                        cosmetics, and essentials all in one place.
                    </p>

                    <div class="hero-buttons">
                        <a href="{{ route('user.shop') }}"
                        class="primary-btn">
                            Shop Now
                        </a>

                        <a href="#featured-products"
                        class="secondary-btn">
                            Explore
                        </a>
                    </div>
                </div>

                <div class="hero-image">
                    <img src="{{ asset('images/userBanner.jpg') }}"
                        alt="Store Banner">
                </div>

            </div>

        </div>
    </section>

    {{-- FEATURE BAR --}}
    <section class="feature-bar">
        <div class="main-container">

            <div class="feature-grid">

                <div class="feature-item">
                    <i class="fa-solid fa-truck-fast"></i>
                    <div>
                        <h5>Fast Delivery</h5>
                        <p>Quick delivery service</p>
                    </div>
                </div>

                <div class="feature-item">
                    <i class="fa-solid fa-shield-heart"></i>
                    <div>
                        <h5>Secure Payment</h5>
                        <p>100% protected checkout</p>
                    </div>
                </div>

                <div class="feature-item">
                    <i class="fa-solid fa-box-open"></i>
                    <div>
                        <h5>Fresh Products</h5>
                        <p>Quality guaranteed</p>
                    </div>
                </div>

                <div class="feature-item">
                    <i class="fa-solid fa-headset"></i>
                    <div>
                        <h5>24/7 Support</h5>
                        <p>Always ready to help</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- CATEGORIES --}}
    <section class="category-section">

        <div class="main-container">

            <div class="section-title">
                <h2>Shop By Categories</h2>
                <p>Explore your favorite products</p>
            </div>

            <div class="category-grid">

                @foreach ($categories->take(5) as $category)

                    <a href="{{ route('user.shop', ['category_id' => $category->id]) }}"
                    class="category-card">

                        <div class="category-icon">
                            <i class="fa-solid fa-store"></i>
                        </div>

                        <h5>{{ $category->name }}</h5>

                    </a>

                @endforeach

            </div>

        </div>

    </section>

    {{-- FEATURED PRODUCTS --}}
    <section class="products-section my-4"
            id="featured-products">

        <div class="main-container">

            <div class="section-title">

                <h2>
                    Featured Products
                </h2>

                <p>
                    Most popular products in store
                </p>

            </div>

            <div class="featured-carousel-wrapper">

                <!-- LEFT BUTTON -->

                <button class="custom-carousel-btn prev-btn"
                        type="button"
                        data-bs-target="#featuredCarousel"
                        data-bs-slide="prev">

                    <i class="fa-solid fa-chevron-left"></i>

                </button>

                <!-- CAROUSEL -->

                <div id="featuredCarousel"
                    class="carousel slide flex-grow-1"
                    data-bs-ride="carousel">

                    <div class="carousel-inner">

                        @foreach ($productVariants->chunk(4) as $key => $chunk)

                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                                <div class="products-grid">

                                    @foreach ($chunk as $variant)

                                        <div class="modern-product-card">

                                            <div class="product-image-wrapper position-relative">

                                                <img src="{{ $variant->image
                                                    ? asset('images/' . $variant->image)
                                                    : 'default'
                                                }}"
                                                    alt="Product">

                                                <span class="product-badge">

                                                    {{ $variant->product->item }}

                                                </span>

                                            </div>

                                            <div class="product-content">

                                                <h4>
                                                    {{ $variant->product->brand }}
                                                </h4>

                                                <p class="product-size">

                                                    {{ $variant->size }}

                                                </p>

                                                <div class="product-price">

                                                    {{ number_format($variant->price) }} Ks

                                                </div>

                                                <div class="product-stock">

                                                    {{ $variant->stock }} instocks

                                                </div>

                                                <a href="{{ route('user.details', $variant->id) }}"
                                                class="view-btn">

                                                    View Details

                                                </a>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

                <!-- RIGHT BUTTON -->

                <button class="custom-carousel-btn next-btn"
                        type="button"
                        data-bs-target="#featuredCarousel"
                        data-bs-slide="next">

                    <i class="fa-solid fa-chevron-right"></i>

                </button>

            </div>

        </div>

    </section>

    {{-- PROMO BANNER --}}
    <section class="promo-section my-5 w-75 mx-auto">

        <div class="main-container">

            <div class="promo-banner">

                <div>
                    <h2>Special Weekend Offer</h2>

                    <p>
                        Get amazing discounts on selected products this week.
                    </p>
                </div>

                <a href="{{ route('user.shop') }}"
                class="primary-btn">
                    Shop Deals
                </a>

            </div>

        </div>

    </section>

    {{-- REVIEWS --}}
    <section class="review-section my-5">

        <div class="main-container">

            <div class="section-title">
                <h2>Customer Reviews</h2>
                <p>What customers say about us</p>
            </div>

            <div class="review-grid">

            @forelse ($reviews as $review)

                <div class="review-card">

                    <p class="review-text">
                        " {{ $review->review }} "
                    </p>

                    <div class="review-user">

                        <!-- <div class="review-avatar">
                            {{ $review->user->image }}
                        </div> -->

                        <div class="review-info">
                            <h5>{{ $review->name }}</h5>

                            <span class="review-email">
                                {{ $review->email }}
                            </span>
                        </div>

                    </div>

                </div>

            @empty

                <div class="no-review">
                    No reviews available yet.
                </div>

            @endforelse

        </div>

        </div>

    </section>

    {{-- NEWSLETTER --}}
    <section class="newsletter-section">

        <div class="main-container">

            <div class="newsletter-box">

                <h2>Get Latest Updates</h2>

                <p>
                    Subscribe for promotions and product updates.
                </p>

                <form class="newsletter-form">

                    <input type="email"
                        placeholder="Enter your email">

                    <button type="submit">
                        Subscribe
                    </button>

                </form>

            </div>

        </div>

    </section>

    {{-- FOOTER --}}

    <footer class="modern-footer">

        <div class="main-container">

            <div class="footer-grid">

                <!-- BRAND -->

                <div>

                    <h3 class="mb-4 fw-bold">
                        <i class="fa-solid fa-bag-shopping me-2"></i>
                        KC Store
                    </h3>

                    <p class="text-light-emphasis">

                        Your trusted ecommerce platform for affordable products,
                        secure payments and smooth shopping experience.

                    </p>

                    <div class="d-flex gap-3 mt-4">

                        <a href="https://t.me/caxper24" class="footer-social-icon">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>

                        <a href="https://t.me/caxper24" class="footer-social-icon">
                            <i class="fa-brands fa-telegram"></i>
                        </a>

                        <a href="mailto:khaprime25@gmail.com" class="footer-social-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </a>

                        <a href="#" class="footer-social-icon">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>

                    </div>

                </div>

                <!-- SHOP -->

                <div>

                    <h5 class="mb-4 fw-bold">
                        Shop
                    </h5>

                    <ul>

                        <li class="mb-3">
                            <a href="{{ route('user.shop') }}">
                                All Products
                            </a>
                        </li>

                        <li class="mb-3">
                            <a href="{{ route('user.cart') }}">
                                Shopping Cart
                            </a>
                        </li>

                        <li class="mb-3">
                            <a href="{{ route('user.order') }}">
                                My Orders
                            </a>
                        </li>

                        <li class="mb-3">
                            <a href="{{ route('user.shop') }}">
                                New Arrivals
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- CUSTOMER SUPPORT -->

                <div>

                    <h5 class="mb-4 fw-bold">
                        Customer Support
                    </h5>

                    <ul>

                        <li class="mb-3">
                            <a href="{{ route('user.contact') }}">
                                Contact Us
                            </a>
                        </li>

                        <li class="mb-3">
                            <a href="{{ route('user.contact') }}">
                                Live Support
                            </a>
                        </li>

                        <li class="mb-3">
                            <a href="{{ route('user.contact') }}">
                                FAQs
                            </a>
                        </li>

                        <li class="mb-3">
                            <a href="{{ route('user.contact') }}">
                                Help Center
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- PAYMENT & DELIVERY -->

                <div>

                    <h5 class="mb-4 fw-bold">
                        Payments & Delivery
                    </h5>

                    <ul>

                        <li class="mb-3">
                            <a href="{{ route('user.contact') }}">
                                KBZ Pay
                            </a>
                        </li>

                        <li class="mb-3">
                            <a href="{{ route('user.contact') }}">
                                WavePay
                            </a>
                        </li>


                        <li class="mb-3">
                            <a href="{{ route('user.order') }}">
                                Delivery Information
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

            <!-- FOOTER BOTTOM -->

            <div class="footer-bottom">

                <div class="footer-bottom-wrapper">

                    <p class="mb-0">
                        © 2026 Caxper MiniStore. All rights reserved.
                    </p>

                    <div class="footer-bottom-links">

                        <a href="{{ route('user.contact') }}">
                            Terms & Conditions
                        </a>

                        <a href="{{ route('user.contact') }}">
                            Support Center
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </footer>

</x-user-layout>