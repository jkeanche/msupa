<!-- Customer Sidebar -->
<div class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white shadow-xl transition-transform duration-300 ease-in-out transform" 
    x-data="{ open: true }" 
    :class="{'translate-x-0': open, '-translate-x-full': !open}">
    
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-4 border-b border-blue-500">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8">
            <h1 class="text-xl font-bold">m-Supa</h1>
        </div>
        <button @click="open = !open" class="lg:hidden text-white hover:text-blue-200">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-4 px-4">
        <div class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('customer.dashboard') }}" 
                class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.dashboard') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                <i class="fas fa-home w-5 h-5 mr-3"></i>
                <span>Home</span>
            </a>

            <!-- Shopping -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-blue-300 uppercase tracking-wider">Shopping</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('customer.supermarkets.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.supermarkets.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        <i class="fas fa-store w-5 h-5 mr-3"></i>
                        <span>Supermarkets</span>
                    </a>
                    <a href="{{ route('customer.categories.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.categories.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        <i class="fas fa-th-large w-5 h-5 mr-3"></i>
                        <span>Categories</span>
                    </a>
                    <a href="{{ route('customer.deals.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.deals.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        <i class="fas fa-tag w-5 h-5 mr-3"></i>
                        <span>Deals & Offers</span>
                    </a>
                </div>
            </div>

            <!-- Orders -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-blue-300 uppercase tracking-wider">My Orders</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('customer.orders.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.orders.index') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        <i class="fas fa-shopping-bag w-5 h-5 mr-3"></i>
                        <span>Order History</span>
                    </a>
                    <a href="{{ route('customer.orders.active') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.orders.active') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        <i class="fas fa-clock w-5 h-5 mr-3"></i>
                        <span>Active Orders</span>
                    </a>
                </div>
            </div>

            <!-- Wallet -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-blue-300 uppercase tracking-wider">Wallet</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('customer.wallet.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.wallet.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        <i class="fas fa-wallet w-5 h-5 mr-3"></i>
                        <span>My Wallet</span>
                    </a>
                    <a href="{{ route('customer.transactions.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.transactions.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        <i class="fas fa-history w-5 h-5 mr-3"></i>
                        <span>Transactions</span>
                    </a>
                </div>
            </div>

            <!-- Account -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-blue-300 uppercase tracking-wider">Account</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('customer.profile.edit') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.profile.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        <i class="fas fa-user w-5 h-5 mr-3"></i>
                        <span>Profile</span>
                    </a>
                    <a href="{{ route('customer.addresses.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.addresses.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        <i class="fas fa-map-marker-alt w-5 h-5 mr-3"></i>
                        <span>Addresses</span>
                    </a>
                    <a href="{{ route('customer.settings.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('customer.settings.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- User Profile Section -->
    <div class="absolute bottom-0 w-full p-4 border-t border-blue-500">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" alt="Profile" class="h-10 w-10 rounded-full">
                <div>
                    <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-blue-300">Customer</p>
                </div>
            </div>
            <div class="flex items-center">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ auth()->user()->loyalty_points ?? 0 }} Points
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
