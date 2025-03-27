<!-- Admin Sidebar -->
<div class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-indigo-600 to-indigo-800 text-white shadow-xl transition-transform duration-300 ease-in-out transform" 
    x-data="{ open: true }" 
    :class="{'translate-x-0': open, '-translate-x-full': !open}">
    
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-4 border-b border-indigo-500">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8">
            <h1 class="text-xl font-bold">m-Supa Admin</h1>
        </div>
        <button @click="open = !open" class="lg:hidden text-white hover:text-indigo-200">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-4 px-4">
        <div class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700' }}">
                <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                <span>My Dashboard</span>
            </a>

            <!-- Store Management Section -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">Store Management</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('admin.products.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700' }}">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span>Products</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700' }}">
                        <i class="fas fa-tags w-5 h-5 mr-3"></i>
                        <span>Categories</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700' }}">
                        <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                        <span>Orders</span>
                    </a>
                </div>
            </div>

            <!-- Marketing Section -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">Marketing</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('admin.banners.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.banners.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700' }}">
                        <i class="fas fa-image w-5 h-5 mr-3"></i>
                        <span>Banners</span>
                    </a>
                    <a href="{{ route('admin.coupons.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.coupons.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700' }}">
                        <i class="fas fa-ticket-alt w-5 h-5 mr-3"></i>
                        <span>Coupons</span>
                    </a>
                </div>
            </div>

            <!-- User Management -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">User Management</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('admin.users.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700' }}">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('admin.supermarkets.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.supermarkets.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700' }}">
                        <i class="fas fa-store w-5 h-5 mr-3"></i>
                        <span>Supermarkets</span>
                    </a>
                </div>
            </div>

            <!-- System -->
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">System</p>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('admin.settings.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700' }}">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i>
                        <span>Settings</span>
                    </a>
                    <a href="{{ route('admin.reports.index') }}" 
                        class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700' }}">
                        <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                        <span>Reports</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- User Profile Section -->
    <div class="absolute bottom-0 w-full p-4 border-t border-indigo-500">
        <div class="flex items-center space-x-3">
            <img src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" alt="Profile" class="h-10 w-10 rounded-full">
            <div>
                <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                <p class="text-xs text-indigo-300">Administrator</p>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Sidebar Overlay -->
<div x-show="!open" 
    @click="open = true"
    class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden">
</div>
