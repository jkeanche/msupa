<div class="flex flex-col w-64">
    <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-blue-800 border-r">
        <div class="flex flex-col items-center flex-shrink-0 px-4">
            <a href="{{ route('dashboard') }}" class="text-lg font-semibold tracking-widest text-white uppercase rounded-lg focus:outline-none focus:shadow-outline">
                m-Supa
            </a>
            <p class="text-sm text-blue-200">{{ auth()->user()->name }}</p>
        </div>
        <div class="flex flex-col flex-grow px-4 mt-5">
            <nav class="flex-1 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('dashboard') ? 'bg-blue-700' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
                
                <div class="space-y-1">
                    <p class="px-4 pt-4 text-xs font-semibold text-blue-300 uppercase tracking-wider">
                        Shopping
                    </p>
                    
                    <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('products.index') ? 'bg-blue-700' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                        </svg>
                        <span>Browse Products</span>
                    </a>
                    
                    <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('categories.index') ? 'bg-blue-700' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span>Categories</span>
                    </a>
                    
                    <a href="{{ route('stores.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('stores.index') ? 'bg-blue-700' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span>Stores</span>
                    </a>
                    
                    <a href="{{ route('cart.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('cart.index') ? 'bg-blue-700' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>My Cart</span>
                    </a>
                </div>
                
                <div class="space-y-1">
                    <p class="px-4 pt-4 text-xs font-semibold text-blue-300 uppercase tracking-wider">
                        My Account
                    </p>
                    
                    <a href="{{ route('user.orders') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('user.orders') ? 'bg-blue-700' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span>My Orders</span>
                    </a>
                    
                    <a href="user.lists" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('user.lists') ? 'bg-blue-700' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>Shopping Lists</span>
                    </a>
                    
                    <a href="user.favorites" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('user.favorites') ? 'bg-blue-700' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span>Favorites</span>
                    </a>
                    
                    <a href="{{ route('user.wallet') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('user.wallet') ? 'bg-blue-700' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <span>My Wallet</span>
                    </a>
                    
                    <a href="user.notifications" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('user.notifications') ? 'bg-blue-700' : '' }}">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span>Notifications</span>
                    </a>
                </div>
                
                <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('user.profile') ? 'bg-blue-700' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Profile</span>
                </a>
                
                <a href="user.settings" class="flex items-center px-4 py-3 text-white transition-colors rounded-md hover:bg-blue-700 {{ request()->routeIs('user.settings') ? 'bg-blue-700' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Settings</span>
                </a>
            </nav>
        </div>
        <div class="flex flex-shrink-0 p-4 border-t border-blue-700">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-white transition-colors rounded-md hover:bg-blue-700">
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
<div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-blue-800 shadow-lg">
    <div class="flex justify-around items-center h-16">
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center text-white hover:bg-blue-700 flex-1 h-full {{ request()->routeIs('dashboard') ? 'bg-blue-700' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-xs">Home</span>
        </a>
        <a href="{{ route('cart.index') }}" class="flex flex-col items-center justify-center text-white hover:bg-blue-700 flex-1 h-full {{ request()->routeIs('cart.index') ? 'bg-blue-700' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="text-xs">Cart</span>
        </a>
        <a href="{{ route('user.orders') }}" class="flex flex-col items-center justify-center text-white hover:bg-blue-700 flex-1 h-full {{ request()->routeIs('user.orders') ? 'bg-blue-700' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <span class="text-xs">Orders</span>
        </a>
        <a href="{{ route('user.profile') }}" class="flex flex-col items-center justify-center text-white hover:bg-blue-700 flex-1 h-full {{ request()->routeIs('user.profile') ? 'bg-blue-700' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="text-xs">Profile</span>
        </a>
    </div>
</div>
