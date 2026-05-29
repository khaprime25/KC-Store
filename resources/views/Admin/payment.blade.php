<x-layout>

    <x-navbar :links="[ 
        'Dashboard' => route('admin.dashboard') 
    ]" :category-id="$category_id ?? 1"/>

    <x-sidebar :links="[ 
        [
            'icon' => 'fa-solid fa-display',
            'link' => route('admin.dashboard'),
            'label' => 'Dashboard',
        ],
        [
            'icon' => 'fa-solid fa-layer-group',
            'link' => route('admin.category.index'),
            'label' => 'Categories',
        ],
        [
            'icon' => 'fa-brands fa-product-hunt',
            'link' => route('admin.category.product.getAllProducts', $category_id = 1),
            'label' => 'Products',
        ],
        [
            'icon' => 'fa-brands fa-product-hunt',
            'link' => route('admin.category.product.ProductVariant.getAllProductVariants'),
            'label' => 'Variants',
        ],
        [
            'icon' => 'fa-solid fa-users',
            'link' => route('admin.users'),
            'label' => 'Users',
        ],
        [
            'icon' => 'fa-solid fa-dollar-sign',
            'link' => route('admin.payment.index'),
            'label' => 'Payment',
        ],
        [
            'icon' => 'fa-solid fa-clipboard',
            'link' => route('admin.order.index'),
            'label' => 'Orders',
        ],
        [
            'icon' => 'fa-solid fa-arrow-right',
            'link' => route('logout'),
            'label' => 'Logout',
        ]
    ]" />



    <div class="content">

        {{-- SUCCESS ALERT --}}
        @if (session('success'))

            <div class="alert alert-success w-75 mx-auto alert-dismissible fade show"
                    role="alert">

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>

            </div>

        @endif



        {{-- CREATE PAYMENT SECTION --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">

            <label class="fw-bold fs-4 mb-4 text-success"
                    for="method">

                {{ $selectedPayment == null ? "Add" : "Update" }}
                Payment Method

            </label>



            <form action="{{ $selectedPayment != null
                    ? route('admin.payment.update', $selectedPayment->first()->id)
                    : route('admin.payment.store') }}"
                method="POST">

                @csrf

                @if ($selectedPayment != null)
                    @method("PUT")
                @endif



                <div class="row">

                    {{-- PAYMENT METHOD --}}
                    <div class="col-12 col-md-6 mb-3">

                        <input type="text"
                                id="method"
                                name="method"
                                class="form-control @error('method') is-invalid @enderror"
                                placeholder="Enter Payment Method ( eg. KPAY )"
                                value="{{ old('method', $selectedPayment == null ? '' : $selectedPayment->first()->method) }}">

                        @error('method')

                            <small class="text-danger fw-bold">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>



                    {{-- ACCOUNT NAME --}}
                    <div class="col-12 col-md-6 mb-3">

                        <input type="text"
                                name="account_name"
                                class="form-control @error('account_name') is-invalid @enderror"
                                placeholder="Enter Account Name ( eg. Kaung Htet Aung )"
                                value="{{ old('account_name', $selectedPayment == null ? '' : $selectedPayment->first()->account_name) }}">

                        @error('account_name')

                            <small class="text-danger fw-bold">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>



                    {{-- ACCOUNT NUMBER --}}
                    <div class="col-12 col-md-6 mb-3">

                        <input type="text"
                                name="account_number"
                                class="form-control @error('account_number') is-invalid @enderror"
                                placeholder="Enter Account Number ( eg. 09687564689 )"
                                value="{{ old('account_number', $selectedPayment == null ? '' : $selectedPayment->first()->account_number) }}">

                        @error('account_number')

                            <small class="text-danger fw-bold">

                                {{ $message }}

                            </small>

                        @enderror

                    </div>

                </div>



                {{-- BUTTON --}}
                <button type="submit"
                        class="btn btn-dark rounded-3 px-4 py-2 mt-2">

                    <i class="fa-solid fa-plus"></i>

                    <span class="ps-2">

                        {{ $selectedPayment == null ? "Add" : "Update" }}

                    </span>

                </button>

            </form>

        </div>



        {{-- PAYMENT TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle bg-white rounded-4 overflow-hidden table-sm text-center">

                <thead class="table-light">

                    <tr>

                        <th scope="col">#</th>

                        <th scope="col">
                            Methods
                        </th>

                        <th scope="col" class="d-none d-md-table-cell">
                            Account Name
                        </th>

                        <th scope="col">
                            Account Number
                        </th>

                        <th scope="col" class="text-center">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($payments as $payment)

                        <tr>

                            {{-- ID --}}
                            <th scope="row" class="fw-bold">

                                {{ $loop->iteration }} .

                            </th>



                            {{-- PAYMENT METHOD --}}
                            <td>

                                <span class="fw-semibold text-success">

                                    {{ $payment->method }}

                                </span>

                            </td>



                            {{-- ACCOUNT NAME --}}
                            <td class="d-none d-md-table-cell">

                                <span class="text-dark">

                                    {{ Str::limit($payment->account_name, 20, ' ...') }}

                                </span>

                            </td>



                            {{-- ACCOUNT NUMBER --}}
                            <td>

                                <span class="text-success fw-semibold">

                                    {{ Str::limit($payment->account_number, 15, ' ...') }}

                                </span>

                            </td>



                            {{-- ACTIONS --}}
                            <td>

                                <div class="d-flex justify-content-center gap-2">

                                    {{-- UPDATE --}}
                                    <a href="{{ route('admin.payment.edit', $payment->id) }}"
                                        class="btn btn-outline-dark rounded-3 px-2 py-1">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>



                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.payment.destroy', $payment->id) }}"
                                            method="POST">

                                        @csrf
                                        @method("DELETE")

                                        <button type="submit"
                                                class="btn btn-outline-danger rounded-3 px-2 py-1"
                                                onclick="return confirm('Delete this payment method?')">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center py-5 fw-bold text-secondary">

                                No Payment Methods Yet!

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>



        {{-- BACK BUTTON --}}
        <button class="btn btn-dark mt-3 rounded-3 px-4"
                onclick="history.back()"
                type="button">

            <i class="fa-solid fa-arrow-left"></i>

            Back

        </button>

    </div>

</x-layout>