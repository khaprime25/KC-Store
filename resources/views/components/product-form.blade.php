{{-- CREATE PRODUCT SECTION START --}}
<div class="my-1">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">

        <label class="fw-bolder fs-4 text-dark m-0" for="category">

            {{ $product ? "Update" : "Create" }} Your Product Page

        </label>

    </div>

    <form
        @if ($product)
            action="{{ route('admin.category.product.update', [$category_id ?? 1, $product]) }}"
        @else
            action="{{ route('admin.category.product.store', $categories->first()->id) }}"
        @endif
        method="POST">

        @csrf

        @if($product)
            @method("PUT")
        @endif


        {{-- CATEGORY SECTION --}}
        <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">

            @if ($categories->first()->id == 1)

                <h6 class="fw-semibold text-success mb-3">
                    Choose Category
                </h6>

                <div class="form-check">

                    @foreach ($categories as $category)

                        <div class="mb-2">

                            <input class="form-check-input"
                                type="radio"
                                name="category_id"
                                id="category{{ $category->id }}"
                                value="{{ $category->id }}"
                                @if(old('category_id', $product['category_id'] ?? null) == $category->id) checked @endif
                                @checked($category->id == 1)
                            >

                            <label class="form-check-label"
                                for="category{{ $category->id }}">

                                {{ $category->name }}

                            </label>

                        </div>

                    @endforeach

                    @error('category_id')

                        <small class="text-danger fw-bold">
                            {{ $message }}
                        </small>

                    @enderror

                </div>

            @else

                <div>

                    <h6 class="fw-semibold text-success mb-0">

                        Category :
                        {{ $categories->first()->name ?? $categories->name }}

                    </h6>

                </div>

                <input type="hidden"
                    name="category_id"
                    value="{{ $categories->first()->id ?? $categories->id }}">

            @endif

        </div>


        {{-- INPUT SECTION --}}
        <div class="card border-0 shadow-sm rounded-4 p-3">

            {{-- ITEM --}}
            <div class="mb-3">

                <label for="item" class="form-label fw-semibold">
                    Product Item
                </label>

                <input type="text"
                    id="item"
                    name="item"
                    class="form-control w-100 w-md-50 mb-1 @error('item') is-invalid @enderror"
                    placeholder="Enter Products' Item ( eg. Peanut Oil )"
                    value="{{ old('item', $product ? $product->item : '') }}">

                @error('item')

                    <small class="text-danger fw-bold">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- BRAND --}}
            <div class="mb-3">

                <label for="brand" class="form-label fw-semibold">
                    Brand Name
                </label>

                <input type="text"
                    id="brand"
                    name="brand"
                    class="form-control w-100 w-md-50 mb-1 @error('brand') is-invalid @enderror"
                    placeholder="Enter Products' Brand ( eg. Kaung Htet )"
                    value="{{ old('brand', $product ? $product->brand : '') }}">

                @error('brand')

                    <small class="text-danger fw-bold">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- DESCRIPTION --}}
            <div class="mb-3">

                <label for="description" class="form-label fw-semibold">
                    Description
                </label>

                <textarea name="description"
                    id="description"
                    rows="3"
                    class="form-control w-100 w-md-50 mb-1 @error('description') is-invalid @enderror"
                    placeholder="Enter Products' Description ( eg. Purity is our priority )">{{ old('description', $product ? $product->description : '') }}</textarea>

                @error('description')

                    <small class="text-danger fw-bold">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- BUTTONS --}}
            <div class="d-flex align-items-center flex-wrap gap-2 mt-2">

                <button class="btn btn-outline-dark rounded-3 px-4"
                        onclick="history.back()"
                        type="button">

                    <i class="fa-solid fa-arrow-left"></i>

                    <span class="ps-2">
                        Back
                    </span>

                </button>

                <button type="submit"
                        class="btn btn-dark rounded-3 px-4">

                    <i class="fa-solid fa-plus"></i>

                    <span class="ps-2">

                        {{ $product ? "Update" : "Create" }}

                    </span>

                </button>

            </div>

        </div>

    </form>

</div>
{{-- CREATE PRODUCT SECTION END --}}