<x-user-layout>
    <x-navbar :categories="$categories"/>

    
    <div class="row mx-auto">
        <div class="col-0 col-md-3 col-lg-3 userSiderbar">

            <div class="border-bottom py-1 mt-3">
                <form action="{{ route('user.shop') }}" method="GET">
                    <div class="">
                        <label for="min_price" class="d-inline text-dark fw-bolder fs-6">Min Price :  </label><input type="number" name="min_price" id="min_price" class="search-input my-2 d-inline" value="{{ request('min_price') }}">
                    </div>
                    <div class="">
                        <label for="max_price" class="d-inline text-dark fw-bolder fs-6">Max Price :  </label><input type="number" name="max_price" id="max-price" class="search-input my-2 d-inline" value="{{ request('max_price') }}">
                    </div>
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <button class="search-button my-2 w-100" type="submit"><i class="fa-solid fa-filter me-2"></i>Filter </button>
                </form>
            </div>

            <div class="d-flex flex-column my-1 border-bottom">
                <div class="text-center my-2">
                    <a href="{{ route('user.shop') }}" class="text-dark fw-bolder fs-3" style="text-decoration:none">Categories</a>
                </div>
                @foreach ($categories as $category)
                    <div class="px-1 mb-3">
                        <a href="{{ route('user.shop', $category->id) }}" class="link fs-6"><i class="fa-solid fa-bullseye me-2"></i>{{ $category->name }}</a>
                    </div>
                @endforeach                
            </div>
        </div>
        <div class="col-12 col-md-9 col-lg-9">
            <h2 class="my-4 fw-bolder text-center">Available Products! </h2>

            <div class="row mx-auto">
                @forelse ($productVariants as $productVariant)
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="shop-card">
                            <div class="shop-card-image">
                                <img src="{{ $productVariant->image 
                                    ? asset('images/'.$productVariant->image) 
                                    : asset('images/default.jpg') }}"
                                    alt="product">
                                
                                <span class="shop-badge">
                                    {{ $productVariant->product->category->name }}
                                </span>
                            </div>

                            <div class="shop-card-body">

                                <h5 class="shop-title">
                                    {{ $productVariant->product->brand }}
                                </h5>

                                <div class="shop-meta">
                                    <span>Size: {{ $productVariant->size }}</span>
                                </div>

                                <div class="shop-price">
                                    {{ number_format($productVariant->price) }} Ks
                                </div>

                                <p class="shop-desc">
                                    {{ Str::limit($productVariant->description, 70) }}
                                </p>

                                <a href="{{ route('user.details', $productVariant->id) }}"
                                class="shop-btn">
                                    View Details
                                </a>

                            </div>

                        </div>
                    </div>
                @empty
                    <div class="">
                        There is no ProductVariants Yet!
                    </div>
                @endforelse
                <div class="d-flex just-content-start mt-3">
                    {{ $productVariants->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-user-layout>