<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS (only for vendor routes) -->
    @if(request()->is('vendor*'))
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/css/animation.css', 'resources/js/app.js'])
    
    @yield('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        @auth
            <div class="flex h-screen overflow-hidden">
                <!-- Sidebar -->
                <div class="hidden md:flex md:flex-shrink-0">
                    @include('partials.sidebar')
                </div>
                
                <div class="flex flex-col flex-1 w-0 overflow-hidden">
                    <!-- Top navigation -->
                    <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
                        <button type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500 md:hidden">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </button>
                        <div class="flex-1 px-4 flex justify-between">
                            <div class="flex-1 flex items-center">
                                <div class="max-w-2xl w-full">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Search" type="search">
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4 flex items-center md:ml-6 space-x-4">
                                <!-- Notifications dropdown -->
                                <div class="relative">
                                    <button type="button" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        <span class="sr-only">View notifications</span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Cart icon -->
                                <a href="{{ route('cart.index') }}" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <span class="sr-only">View cart</span>
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </a>
                                
                                <!-- Profile dropdown -->
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                            <div class="flex items-center">
                                                <img class="h-8 w-8 rounded-full object-cover" src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7F9CF5&background=EBF4FF' }}" alt="{{ auth()->user()->name }}">
                                                <div class="ml-2 hidden md:block">
                                                    <div class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ auth()->user()->role }}</div>
                                                </div>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Profile -->
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <!-- Cart -->
                                        <x-dropdown-link :href="route('cart.index')">
                                            {{ __('Cart') }}
                                        </x-dropdown-link>

                                        <!-- Orders -->
                                        <x-dropdown-link :href="route('orders.index')">
                                            {{ __('Orders') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>

                    <!-- Main content -->
                    <main class="flex-1 relative overflow-y-auto focus:outline-none pb-16 md:pb-0">
                        @hasSection('content')
                            @yield('content')
                        @else
                            {{ $slot ?? '' }}
                        @endif
                    </main>
                </div>
            </div>
            
            <!-- Mobile navigation -->
            <div class="md:hidden">
                @include('partials.sidebar')
            </div>
        @else
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <!-- Logo -->
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('home') }}">
                                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                    {{ __('Home') }}
                                </x-nav-link>
                                <x-nav-link :href="route('stores.index')" :active="request()->routeIs('stores.*')">
                                    {{ __('Stores') }}
                                </x-nav-link>
                                <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                                    {{ __('Categories') }}
                                </x-nav-link>
                                <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                                    {{ __('Products') }}
                                </x-nav-link>
                            </div>
                        </div>

                        <!-- Login/Register Links -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="space-x-4">
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900">Log in</a>
                                <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-gray-900">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </div>
                </div>
            </footer>
        @endauth
    </div>
    
    <!-- Bootstrap JS (only for vendor routes) -->
    @if(request()->is('vendor*'))
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endif
    
    @yield('scripts')
</body>
</html>
