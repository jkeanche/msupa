<div class="flex flex-col w-64">
    <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-indigo-900 border-r">
        <div class="flex flex-col items-center flex-shrink-0 px-4">
            <a href="{{ route('admin.dashboard') }}" class="text-lg font-semibold tracking-widest text-white uppercase rounded-lg focus:outline-none focus:shadow-outline">
                m-Supa Admin
            </a>
            <p class="text-sm text-indigo-200">{{ auth()->user()->name }}</p>
        </div>
        <div class="flex flex-col flex-grow px-4 mt-5">
            <nav class="flex-1 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-800' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
                
                <div class="space-y-1">
                    <p class="px-4 pt-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">
                        Store Management
                    </p>
                    
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.users.*') ? 'bg-indigo-800' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Users</span>
                    </a>
                    
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-800' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span>Categories</span>
                    </a>
                    
                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.products.*') ? 'bg-indigo-800' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                        </svg>
                        <span>Products</span>
                    </a>
                </div>
                
                <div class="space-y-1">
                    <p class="px-4 pt-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">
                        Marketing
                    </p>
                    
                    <a href="{{ route('admin.banners.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.banners.*') ? 'bg-indigo-800' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Banners</span>
                    </a>
                    
                    <a href="{{ route('admin.featured.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.featured.*') ? 'bg-indigo-800' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        <span>Featured Products</span>
                    </a>
                </div>
                
                <div class="space-y-1">
                    <p class="px-4 pt-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">
                        Orders & Payments
                    </p>
                    
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-800' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span>Orders</span>
                    </a>
                    
                    <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.subscriptions.*') ? 'bg-indigo-800' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Subscriptions</span>
                    </a>
                    
                    <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.payments.*') ? 'bg-indigo-800' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>Payments</span>
                    </a>
                </div>
                
                <div class="space-y-1">
                    <p class="px-4 pt-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">
                        System
                    </p>
                    
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-800' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                    </a>
                    
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-indigo-800 {{ request()->routeIs('admin.reports.*') ? 'bg-indigo-800' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>Reports</span>
                    </a>
                </div>
            </nav>
        </div>
        <div class="flex flex-shrink-0 p-4 border-t border-indigo-800">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-white transition-colors rounded-md hover:bg-indigo-800">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Mobile menu button -->
<div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-indigo-900 shadow-lg">
    <div class="flex justify-around items-center h-16">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center justify-center text-white hover:bg-indigo-800 flex-1 h-full {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-800' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-xs">Dashboard</span>
        </a>
        <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center justify-center text-white hover:bg-indigo-800 flex-1 h-full {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-800' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <span class="text-xs">Orders</span>
        </a>
        <a href="{{ route('admin.products.index') }}" class="flex flex-col items-center justify-center text-white hover:bg-indigo-800 flex-1 h-full {{ request()->routeIs('admin.products.*') ? 'bg-indigo-800' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
            </svg>
            <span class="text-xs">Products</span>
        </a>
        <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center justify-center text-white hover:bg-indigo-800 flex-1 h-full {{ request()->routeIs('admin.users.*') ? 'bg-indigo-800' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span class="text-xs">Users</span>
        </a>
    </div>
</div>
