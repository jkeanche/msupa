<div class="flex flex-col w-64">
    <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-gradient-to-br from-indigo-800 to-indigo-900 border-r border-indigo-700">
        <div class="flex flex-col items-center flex-shrink-0 px-4 pb-5 border-b border-indigo-700">
            <a href="{{ route('vendor.dashboard') }}" class="flex items-center space-x-3">
                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-600 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <span class="text-lg font-bold tracking-wide text-white uppercase">
                    {{ auth()->user()->store->name ?? 'My Store' }}
                </span>
            </a>
            <div class="flex items-center mt-2 px-3 py-1.5 rounded-full bg-indigo-700 text-indigo-100 text-sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>{{ auth()->user()->name }}</span>
            </div>
        </div>
        
        <div class="flex flex-col flex-grow px-4 mt-5">
            <nav class="flex-1 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('vendor.dashboard') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.dashboard') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <!-- Store Management -->
                <div class="space-y-1.5">
                    <p class="px-4 pt-5 pb-1 text-xs font-semibold text-indigo-300 uppercase tracking-wider">
                        Store Management
                    </p>
                    
                    <a href="{{ route('vendor.products.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.products.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                        </svg>
                        <span class="font-medium">Products</span>
                    </a>
                    
                    <a href="{{ route('vendor.inventory.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.inventory.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="font-medium">Inventory</span>
                    </a>
                    
                    <a href="{{ route('vendor.categories.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.categories.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span class="font-medium">Categories</span>
                    </a>
                </div>
                
                <!-- Orders & Customers -->
                <div class="space-y-1.5">
                    <p class="px-4 pt-5 pb-1 text-xs font-semibold text-indigo-300 uppercase tracking-wider">
                        Orders & Customers
                    </p>
                    
                    <a href="{{ route('vendor.orders.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.orders.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="font-medium">Orders</span>
                    </a>
                    
                    <a href="{{ route('vendor.customers.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.customers.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">Customers</span>
                    </a>
                    
                    <a href="{{ route('vendor.deliveries.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.deliveries.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>
                        <span class="font-medium">Deliveries</span>
                    </a>
                </div>
                
                <!-- Marketing -->
                <div class="space-y-1.5">
                    <p class="px-4 pt-5 pb-1 text-xs font-semibold text-indigo-300 uppercase tracking-wider">
                        Marketing
                    </p>
                    
                    <a href="{{ route('vendor.promotions.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.promotions.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span class="font-medium">Promotions</span>
                    </a>
                    
                    <a href="{{ route('vendor.coupons.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.coupons.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                        <span class="font-medium">Coupons</span>
                    </a>
                    
                    <a href="{{ route('vendor.featured.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.featured.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        <span class="font-medium">Featured Products</span>
                    </a>
                </div>
                
                <!-- Finance -->
                <div class="space-y-1.5">
                    <p class="px-4 pt-5 pb-1 text-xs font-semibold text-indigo-300 uppercase tracking-wider">
                        Finance
                    </p>
                    
                    <a href="{{ route('vendor.payments.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.payments.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">Payments</span>
                    </a>
                    
                    <a href="{{ route('vendor.subscription.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.subscription.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">Subscription</span>
                    </a>
                </div>
                
                <!-- Analytics -->
                <div class="space-y-1.5">
                    <p class="px-4 pt-5 pb-1 text-xs font-semibold text-indigo-300 uppercase tracking-wider">
                        Analytics
                    </p>
                    
                    <a href="{{ route('vendor.reports.index') }}" class="flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.reports.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="font-medium">Reports</span>
                    </a>
                </div>
                
                <!-- Settings -->
                <a href="{{ route('vendor.settings.index') }}" class="mt-4 flex items-center px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700 {{ request()->routeIs('vendor.settings.*') ? 'bg-indigo-700 shadow-lg shadow-indigo-900/50' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-medium">Settings</span>
                </a>
            </nav>
        </div>
        
        <!-- Logout Section -->
        <div class="flex flex-shrink-0 p-4 mt-6 border-t border-indigo-700">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-3 text-indigo-100 transition-colors rounded-lg hover:bg-indigo-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Mobile menu button -->
<div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-gradient-to-r from-indigo-800 to-indigo-900 shadow-lg">
    <div class="flex justify-around items-center h-16">
        <a href="{{ route('vendor.dashboard') }}" class="flex flex-col items-center justify-center text-indigo-100 hover:bg-indigo-700 flex-1 h-full {{ request()->routeIs('vendor.dashboard') ? 'bg-indigo-700' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-xs mt-1">Home</span>
        </a>
        <a href="{{ route('vendor.products.index') }}" class="flex flex-col items-center justify-center text-indigo-100 hover:bg-indigo-700 flex-1 h-full {{ request()->routeIs('vendor.products.*') ? 'bg-indigo-700' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
            </svg>
            <span class="text-xs mt-1">Products</span>
        </a>
        <a href="{{ route('vendor.orders.index') }}" class="flex flex-col items-center justify-center text-indigo-100 hover:bg-indigo-700 flex-1 h-full {{ request()->routeIs('vendor.orders.*') ? 'bg-indigo-700' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <span class="text-xs mt-1">Orders</span>
        </a>
        <a href="{{ route('vendor.reports.index') }}" class="flex flex-col items-center justify-center text-indigo-100 hover:bg-indigo-700 flex-1 h-full {{ request()->routeIs('vendor.reports.*') ? 'bg-indigo-700' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span class="text-xs mt-1">Reports</span>
        </a>
        <!-- Mobile menu toggle -->
        <button type="button" class="flex flex-col items-center justify-center text-indigo-100 hover:bg-indigo-700 flex-1 h-full relative" id="mobileMenuToggle">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <span class="text-xs mt-1">More</span>
        </button>
    </div>
</div>

<!-- Mobile expanded menu (hidden by default) -->
<div class="fixed inset-0 z-50 bg-indigo-900 bg-opacity-95 hidden md:hidden" id="mobileExpandedMenu">
    <div class="flex flex-col h-full">
        <div class="flex justify-between items-center p-4 border-b border-indigo-700">
            <div class="flex items-center">
                <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-lg font-bold text-white">{{ auth()->user()->store->name ?? 'My Store' }}</p>
                    <p class="text-xs text-indigo-200">{{ auth()->user()->name }}</p>
                </div>
            </div>
            <button type="button" id="closeMobileMenu" class="text-white p-2 rounded-full hover:bg-indigo-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="overflow-y-auto p-4 flex-grow">
            <div class="grid grid-cols-2 gap-4">
                <!-- More menu items -->
                <a href="{{ route('vendor.inventory.index') }}" class="bg-indigo-800 p-4 rounded-xl flex flex-col items-center justify-center text-center hover:bg-indigo-700">
                    <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="mt-2 text-white font-medium">Inventory</span>
                </a>
                <a href="{{ route('vendor.categories.index') }}" class="bg-indigo-800 p-4 rounded-xl flex flex-col items-center justify-center text-center hover:bg-indigo-700">
                    <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="mt-2 text-white font-medium">Categories</span>
                </a>
                <a href="{{ route('vendor.customers.index') }}" class="bg-indigo-800 p-4 rounded-xl flex flex-col items-center justify-center text-center hover:bg-indigo-700">
                    <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="mt-2 text-white font-medium">Customers</span>
                </a>
                <a href="{{ route('vendor.deliveries.index') }}" class="bg-indigo-800 p-4 rounded-xl flex flex-col items-center justify-center text-center hover:bg-indigo-700">
                    <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    <span class="mt-2 text-white font-medium">Deliveries</span>
                </a>
            </div>
            
            <p class="mt-8 mb-4 text-indigo-300 font-semibold text-sm">Marketing</p>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('vendor.promotions.index') }}" class="bg-indigo-800 p-4 rounded-xl flex flex-col items-center justify-center text-center hover:bg-indigo-700">
                    <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span class="mt-2 text-white font-medium">Promotions</span>
                </a>
                <a href="{{ route('vendor.coupons.index') }}" class="bg-indigo-800 p-4 rounded-xl flex flex-col items-center justify-center text-center hover:bg-indigo-700">
                    <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                    <span class="mt-2 text-white font-medium">Coupons</span>
                </a>
            </div>
        </div>
        <div class="p-4 border-t border-indigo-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-indigo-800 hover:bg-indigo-700 text-white p-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Add JavaScript for mobile menu toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileExpandedMenu = document.getElementById('mobileExpandedMenu');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        
        if(mobileMenuToggle && mobileExpandedMenu && closeMobileMenu) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileExpandedMenu.classList.toggle('hidden');
            });
            
            closeMobileMenu.addEventListener('click', function() {
                mobileExpandedMenu.classList.add('hidden');
            });
        }
    });
</script>