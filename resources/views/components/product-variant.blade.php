<label for="price"
        class="mb-4 link fs-3">

    {{ $productVariant ? "Update" : "Create" }}
    Product Variant !

</label>


<form action="{{ $productVariant
        ? route('admin.category.product.productVariant.update', [

            $productVariant->product->category_id,
            $productVariant->product_id,
            $productVariant->id

        ])

        : route('admin.category.product.productVariant.store', [

            $products->first()->category_id,
            $products->first()->id

        ])
    }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf


    {{-- LOOP PRODUCTS OR SINGLE PRODUCT SECTION START --}}
    @if ($productVariant !== null)

        {{-- UPDATE SECTION --}}
        @method("PUT")

        <div class="mb-4">

            <h4 >

                {{ $productVariant->product->brand }} ( {{ $productVariant->product->item }} )

            </h4>

            <input type="hidden"
                    name="product_id"
                    value="{{ $productVariant->product_id }}">

        </div>

    @else

        {{-- STORE SECTION --}}
            @if ($products->count() > 1)
            <div class="mb-4">

                @foreach ($products as $product)

                    <div class="form-check mb-2">

                        <input class="form-check-input"
                                type="radio"
                                name="product_id"
                                id="product{{ $product->id }}"
                                value="{{ $product->id }}"

                                {{ old('product_id') == $product->id
                                    ? 'checked'
                                    : ($product->id == 1 ? 'checked' : "") }}>

                        <label class="form-check-label"
                                for="product{{ $product->id }}">
                            {{ $product->brand }}

                        </label>

                    </div>

                @endforeach

            </div>

        @else

            <div class="mb-4">

                <h6 class="fw-bold text-dark">

                    Product :

                    <span class="text-success">

                        {{ $products->first()->brand }}

                        {{ $products->first()->item }}

                    </span>

                </h6>

                <input type="hidden"
                        name="product_id"
                        value="{{ $products->first()->id }}">

            </div>

        @endif

    @endif
    {{-- LOOP PRODUCTS OR SINGLE PRODUCT SECTION END --}}



    {{-- IMAGE PREVIEW --}}
    @if ($productVariant ? $productVariant->image !== null : false)

        <div class="mb-4">

            <img src="{{ asset('images/'. $productVariant->image) }}"
                alt="product image"
                style="height: 15rem"
                class="rounded shadow-sm">

        </div>

    @endif



    {{-- INPUTS SECTION START --}}
    <div class="row">

        {{-- IMAGE --}}
        <div class="col-12 col-md-6 mb-3">

            <input type="file"
                    id="image"
                    name="image"
                    class="form-control @error('image') is-invalid @enderror">

            @error('image')

                <small class="text-danger fw-bold">

                    {{ $message }}

                </small>

            @enderror

        </div>



        {{-- PRICE --}}
        <div class="col-12 col-md-6 mb-3">

            <input type="number"
                    id="price"
                    name="price"
                    class="form-control @error('price') is-invalid @enderror"
                    placeholder="Enter Products' price ( eg. 10000 )"
                    value="{{ old('price', $productVariant ? $productVariant->price : "") }}">

            @error('price')

                <small class="text-danger fw-bold">

                    {{ $message }}

                </small>

            @enderror

        </div>



        {{-- SIZE --}}
        <div class="col-12 col-md-6 mb-3">

            <input type="text"
                    id="size"
                    name="size"
                    class="form-control @error('size') is-invalid @enderror"
                    placeholder="Enter Products' size ( eg. 1 Viss, 1 Box, 1 Pack )"
                    value="{{ old('size', $productVariant ? $productVariant->size : "") }}">

            @error('size')

                <small class="text-danger fw-bold">

                    {{ $message }}

                </small>

            @enderror

        </div>



        {{-- STOCK --}}
        <div class="col-12 col-md-6 mb-3">

            <input type="number"
                    id="stock"
                    name="stock"
                    class="form-control @error('stock') is-invalid @enderror"
                    placeholder="Enter Products' stock ( eg. 100 )"
                    value="{{ old('stock', $productVariant ? $productVariant->stock : "") }}">

            @error('stock')

                <small class="text-danger fw-bold">

                    {{ $message }}

                </small>

            @enderror

        </div>



        {{-- DESCRIPTION --}}
        <div class="col-12 col-md-6 mb-3">

            <textarea name="description"
                        id="description"
                        rows="3"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Enter Products' Description ( eg. Purity is our priority )">{{ old('description', $productVariant ? $productVariant->description : "") }}</textarea>

            @error('description')

                <small class="text-danger fw-bold">

                    {{ $message }}

                </small>

            @enderror

        </div>

    </div>
    {{-- INPUTS SECTION END --}}



    {{-- BUTTONS --}}
    <div class="d-flex align-items-center gap-3 mt-3 flex-wrap">

        {{-- BACK --}}
        <button class="btn btn-outline-dark"
                onclick="history.back()"
                type="button">

            <i class="fa-solid fa-arrow-left"></i>

            Back

        </button>


        {{-- SUBMIT --}}
        <button type="submit"
                class="btn btn-dark">

            <i class="fa-solid fa-plus"></i>

            <span class="ps-2">

                {{ $productVariant ? "Update" : "Create" }}

            </span>

        </button>

    </div>

</form>