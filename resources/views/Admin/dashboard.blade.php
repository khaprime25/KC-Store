@props(['links'])

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
        ],[
            'icon' => 'fa-solid fa-dollar-sign',
            'link' => route('admin.payment.index'),
            'label' => 'Payment',
        ],[
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
        <div class="w-100 pe-5">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h3 class="ms-3">Admin Dashboard</h3>
            </div>
        
            <!-- Content Row -->
            <div class="row">
        
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ route('admin.users') }}" class="text-decoration-none">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-orange-800 text-uppercase mb-1">
                                            Admin & User</div>
                                    <div class="text-black"> {{$userCount}} People</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-2x text-primary fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
        
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="#" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-orange-800 text-uppercase mb-1">
                                        Weekly Sales</div>
                                    <div class="text-black">{{ number_format($weeklySales, 0) }} MMK</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-2x text-success fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
        
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ route('admin.payment.index') }}" class="text-decoration-none">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-orange-800 text-uppercase mb-1">
                                        Payments</div>
                                    <div class="text-black"> {{$paymentCount}} Methods</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-2x text-warning fa-money-check-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
        
                <!-- Pending Requests Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="#" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-orange-800 text-uppercase mb-1">
                                        Blogs</div>
                                    <div class="text-black"> Total Blogs : 0</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-brands fa-2x text-orange-800 fa-blogger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
        
                    <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ route('admin.category.index') }}" class="text-decoration-none">
                    <div class="card border-left-dark shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-orange-800 text-uppercase mb-1">
                                        Categories</div>
                                    <div class="text-black"> Total Categories : {{$categoryCount}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-2x text-dark fa-layer-group"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
        
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ route('admin.category.product.getAllProducts', ['category' => 1]) }}"
                    class="text-decoration-none">                    
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-orange-800 text-uppercase mb-1">
                                        Products</div>
                                    <div class="text-black"> Total Products : {{$productCount}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-2x text-orange-800 fa-wine-bottle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
        
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ route('admin.order.index') }}" class="text-decoration-none">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-orange-800 text-uppercase mb-1">
                                        Pending Orders</div>
                                    <div class="text-black"> Total Orders : {{$pendingOrders}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-2x text-warning fa-clock"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
        
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ route('admin.order.index') }}" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-orange-800 text-uppercase mb-1">
                                        Confirmed Orders</div>
                                    <div class="text-black"> Total Orders : {{$confirmedOrders}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-2x text-primary fa-circle-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
        
                <!-- Pending Requests Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ route('admin.order.index') }}" class="text-decoration-none">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-orange-800 text-uppercase mb-1">
                                        Delivered Orders</div>
                                    <div class="text-black"> Total Orders : {{$deliveredOrders}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-2x text-success fa-bus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <button class="btn btn-dark" onclick="history.back()" type="button"><i class="fa-solid fa-arrow-left"></i> Back</button>
            </div>
    </div>

</x-layout>