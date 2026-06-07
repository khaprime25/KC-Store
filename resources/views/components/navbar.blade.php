<nav class="ecom-navbar">

    <div class="ecom-navbar-container px-3">

        <div class="ecom-topbar">

            {{-- LEFT --}}
            <div class="ecom-left">

                {{-- ADMIN MOBILE MENU --}}
                @if (Auth::check() && Auth::user()->role == 'admin')

                    <button type="button"
                            class="admin-menu-btn d-lg-none"
                            id="menuToggle">

                        <i class="fa-solid fa-bars"></i>

                    </button>

                @endif


                {{-- USER MOBILE MENU --}}
                @if (!Auth::check() || Auth::user()->role == 'user')

                    <button class="mobile-toggle d-lg-none"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#mobileNav">

                        <i class="fa-solid fa-bars"></i>

                    </button>

                @endif


                {{-- BRAND --}}
                <a href="{{ Auth::check() && Auth::user()->role == 'admin'
                        ? route('admin.dashboard')
                        : route('user.dashboard') }}"
                class="ecom-brand">

                    <i class="fa-solid fa-shop"></i>

                    <span class="ecom-link">
                        KC Store
                    </span>

                </a>

            </div>


            {{-- USER SEARCH --}}
            @if (!Auth::check() || Auth::user()->role == 'user')

                <div class="ecom-search-wrapper">

                    <form action="{{ route('user.shop') }}"
                        method="GET"
                        class="ecom-search">

                        <select name="category_id"
                                class="ecom-search-select">

                            <option value="">All</option>

                            @foreach ($categories as $category)

                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        <input type="text"
                            name="search"
                            class="ecom-search-input"
                            placeholder="Search products...">

                        <button type="submit"
                                class="ecom-search-btn">

                            <i class="fa-solid fa-magnifying-glass"></i>

                        </button>

                    </form>

                </div>

            @endif


            {{-- RIGHT --}}
            <div class="ecom-right d-none d-lg-flex">

                {{-- ADMIN DESKTOP --}}
                @if (Auth::check() && Auth::user()->role == 'admin')

                    <a href="{{ route('admin.users') }}"
                    class="ecom-link">

                        <i class="fa-solid fa-users"></i>
                        <span>Users</span>

                    </a>

                    <a href="{{ route('admin.category.product.ProductVariant.getAllProductVariants') }}"
                    class="ecom-link">

                        <i class="fa-brands fa-product-hunt"></i>
                        <span>Products</span>

                    </a>

                    <a href="{{ route('admin.order.index') }}"
                    class="ecom-link">

                        <i class="fa-solid fa-clipboard"></i>
                        <span>Orders</span>

                    </a>

                @endif


                {{-- USER DESKTOP --}}
                @if (Auth::check() && Auth::user()->role == 'user')

                    <a href="{{ route('user.shop') }}"
                    class="ecom-link">

                        <i class="fa-solid fa-store"></i>
                        <span>Shop</span>

                    </a>

                    <a href="{{ route('user.cart') }}"
                    class="ecom-link">

                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Cart</span>

                    </a>

                    <a href="{{ route('user.order') }}"
                    class="ecom-link">

                        <i class="fa-solid fa-box"></i>
                        <span>Orders</span>

                    </a>

                    <a href="{{ route('user.contact') }}"
                    class="ecom-link">

                        <i class="fa-solid fa-phone"></i>
                        <span>CS</span>

                    </a>

                    <a href="{{ route('user.profiles') }}"
                    class="ecom-link profile-nav-link">

                        @if(Auth::user()->profile_image)

                            <img src="{{ asset(auth()->user()->profile_image) }}"
                                alt="Profile"
                                class="navbar-avatar">

                        @else

                            <i class="fa-solid fa-circle-user"></i>

                        @endif

                        <span class="profile-name">
                            {{ Str::limit(Auth::user()->name, 1, '') }}                        
                        </span>

                    </a>

                @endif


                {{-- LOGIN / LOGOUT --}}
                @guest

                    <a href="{{ route('login') }}"
                    class="logout-btn text-decoration-none">

                        Login

                    </a>

                @else

                    <form action="{{ route('logout') }}"
                        method="POST">

                        @csrf

                        <button type="submit"
                                class="logout-btn">

                            Logout

                        </button>

                    </form>

                @endguest

            </div>

        </div>

    </div>


    {{-- USER MOBILE NAV --}}
    @if (!Auth::check() || Auth::user()->role == 'user')

        <div class="collapse mobile-nav"
            id="mobileNav">

            <div class="mobile-nav-content">

                <a href="{{ route('user.shop') }}"
                class="mobile-nav-link">

                    <i class="fa-solid fa-store"></i>
                    Shop

                </a>

                <a href="{{ route('user.cart') }}"
                class="mobile-nav-link">

                    <i class="fa-solid fa-cart-shopping"></i>
                    Cart

                </a>

                <a href="{{ route('user.order') }}"
                class="mobile-nav-link">

                    <i class="fa-solid fa-box"></i>
                    Orders

                </a>

                <a href="{{ route('user.contact') }}"
                class="mobile-nav-link">

                    <i class="fa-solid fa-phone"></i>
                    CS

                </a>

                

                {{-- LOGIN / LOGOUT --}}
                @guest

                    <a href="{{ route('login') }}"
                    class="mobile-nav-link">

                        <i class="fa-solid fa-arrow-right"></i>
                        Login

                    </a>

                @else
                    <a href="{{ route('user.profiles') }}"
                        class="mobile-nav-link profile-nav-link">

                            @if(Auth::user()->profile_image)

                                <img src="{{ asset(auth()->user()->profile_image) }}"
                                    alt="Profile"
                                    class="navbar-avatar">

                            @else

                                <i class="fa-solid fa-circle-user"></i>

                            @endif

                            <span class="profile-name">
                                {{ Auth::user()->name }}
                            </span>

                    </a>
                    <form action="{{ route('logout') }}"
                        method="POST">

                        @csrf

                        <button type="submit"
                                class="mobile-nav-link logout-mobile">

                            <i class="fa-solid fa-arrow-right"></i>
                            Logout

                        </button>

                    </form>

                @endguest

            </div>

        </div>

    @endif

</nav>


{{-- ADMIN SIDEBAR SCRIPT --}}
@if (Auth::check() && Auth::user()->role == 'admin')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        if(menuToggle){

            menuToggle.addEventListener('click', function(){

                sidebar.classList.toggle('active');

            });

        }

    });

</script>

@endif