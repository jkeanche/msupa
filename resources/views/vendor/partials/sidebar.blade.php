<!-- Vendor Sidebar -->
<div class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-emerald-600 to-emerald-800 text-white shadow-xl transition-transform duration-300 ease-in-out transform" 
    x-data="{ open: true }" 
    :class="{'translate-x-0': open, '-translate-x-full': !open}">
    
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-4 border-b border-emerald-500">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8">
            <h1 class="text-xl font-bold">{{ auth()->user()->store->name ?? 'Vendor Store' }}</h1>
        </div>
        <button @click="open = !open" class="lg:hidden text-white hover:text-emerald-200">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-4 px-4">
        <div class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('vendor.dashboard') }}" 
                class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.dashboard') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                <span>Dashboard</span>
            </a>

            <!-- Products Management -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Products</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('vendor.products.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.products.*') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span>All Products</span>
                    </a>
                    <a href="{{ route('vendor.products.create') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.products.create') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-plus w-5 h-5 mr-3"></i>
                        <span>Add Product</span>
                    </a>
                    <a href="{{ route('vendor.categories.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.categories.*') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-tags w-5 h-5 mr-3"></i>
                        <span>Categories</span>
                    </a>
                </div>
            </div>

            <!-- Orders -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Orders</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('vendor.orders.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.orders.index') && !request()->has('status') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                        <span>All Orders</span>
                    </a>
                    <a href="{{ route('vendor.orders.pending') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.orders.pending') || (request()->routeIs('vendor.orders.status') && request('status') == 'pending') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-clock w-5 h-5 mr-3"></i>
                        <span>Pending Orders</span>
                    </a>
                    <a href="{{ route('vendor.orders.processing') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.orders.processing') || (request()->routeIs('vendor.orders.status') && request('status') == 'processing') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i>
                        <span>Processing</span>
                    </a>
                    <a href="{{ route('vendor.orders.shipped') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.orders.shipped') || (request()->routeIs('vendor.orders.status') && request('status') == 'shipped') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-truck w-5 h-5 mr-3"></i>
                        <span>Shipped</span>
                    </a>
                    <a href="{{ route('vendor.orders.delivered') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.orders.delivered') || (request()->routeIs('vendor.orders.status') && request('status') == 'delivered') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-check-circle w-5 h-5 mr-3"></i>
                        <span>Delivered</span>
                    </a>
                    <a href="{{ route('vendor.orders.cancelled') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.orders.cancelled') || (request()->routeIs('vendor.orders.status') && request('status') == 'cancelled') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-ban w-5 h-5 mr-3"></i>
                        <span>Cancelled</span>
                    </a>
                </div>
            </div>

            <!-- Marketing -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Marketing</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('vendor.coupons.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.coupons.*') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-ticket-alt w-5 h-5 mr-3"></i>
                        <span>Coupons</span>
                    </a>
                    <a href="{{ route('vendor.promotions.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.promotions.*') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-percentage w-5 h-5 mr-3"></i>
                        <span>Promotions</span>
                    </a>
                </div>
            </div>

            <!-- Finance -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Finance</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('vendor.withdrawals.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.withdrawals.*') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-wallet w-5 h-5 mr-3"></i>
                        <span>Withdrawals</span>
                    </a>
                    <a href="{{ route('vendor.payments.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.payments.*') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-money-bill-wave w-5 h-5 mr-3"></i>
                        <span>Payments</span>
                    </a>
                </div>
            </div>

            <!-- Settings -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Settings</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('vendor.settings.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.settings.*') ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i>
                        <span>Store Settings</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Store Status -->
    <div class="absolute bottom-0 w-full p-4 border-t border-emerald-500">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" alt="Profile" class="h-10 w-10 rounded-full">
                <div>
                    <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-emerald-300">Store Owner</p>
                </div>
            </div>
            <div class="flex items-center">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ auth()->user()->store->is_active ?? true ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                    {{ auth()->user()->store->is_active ?? true ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Sidebar Overlay -->
<div x-show="!open" 
    @click="open = true"
    class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden">
</div>
