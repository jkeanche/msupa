<!-- filepath: c:\xampp\htdocs\msupa\resources\views\admin\dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="flex h-screen bg-neutral-100">
    <!-- Sidebar -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64">
            <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-primary-800 border-r">
                <div class="flex flex-col items-center flex-shrink-0 px-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-lg font-heading font-semibold tracking-widest text-white uppercase rounded-lg focus:outline-none focus:shadow-outline">
                        m-Supa Admin
                    </a>
                </div>
                <div class="flex flex-col flex-grow px-4 mt-5">
                    <nav class="flex-1 space-y-1 bg-primary-800">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-white bg-primary-900 rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('admin.stores.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Stores
                        </a>
                        
                        <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Users
                        </a>
                        
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Orders
                        </a>
                        
                        <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                            </svg>
                            Products
                        </a>
                        
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Categories
                        </a>
                        
                        <a href="{{ route('admin.coupons.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Coupons
                        </a>
                        
                        <a href="{{ route('admin.banners.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Banners
                        </a>
                        
                        <a href="{{ route('admin.withdrawals.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Withdrawals
                        </a>
                        
                        <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Reports
                        </a>
                        
                        <a href="{{ route('admin.notifications.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            Notifications
                        </a>
                        
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </a>
                        
                        <a href="{{ route('admin.roles.index') }}" class="flex items-center px-4 py-2 mt-2 text-white rounded-md hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                            Roles
                        </a>
                    </nav>
                </div>
                <div class="flex flex-shrink-0 p-4 border-t border-primary-700">
                    <a href="#" class="flex-shrink-0 block w-full group">
                        <div class="flex items-center">
                            <div>
                                <img class="inline-block w-9 h-9 rounded-full" src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.auth()->user()->name }}" alt="">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                                <p class="text-xs font-medium text-primary-200 group-hover:text-white">Logout</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div class="md:hidden fixed inset-0 flex z-40 lg:hidden" role="dialog" aria-modal="true">
        <!-- Off-canvas menu overlay -->
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
        
        <!-- Off-canvas menu -->
        <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-primary-800">
            <!-- Close button -->
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Mobile menu content (same as desktop sidebar) -->
            <!-- ... -->
        </div>
    </div>

    <!-- Main content -->
    <div class="flex flex-col flex-1 overflow-hidden">
        <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow-sm">
            <button type="button" class="px-4 border-r border-gray-200 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500 md:hidden">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </button>
            <div class="flex-1 px-4 flex justify-between sm:px-6 lg:max-w-6xl lg:mx-auto lg:px-8">
                <div class="flex-1 flex">
                    <form class="w-full flex md:ml-0" action="#" method="GET">
                        <label for="search-field" class="sr-only">Search</label>
                        <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none" aria-hidden="true">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                </svg>
                            </div>
                            <input id="search-field" name="search" class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm" placeholder="Search" type="search">
                        </div>
                    </form>
                </div>
                <div class="ml-4 flex items-center md:ml-6">
                    <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                        <div>
                            <button type="button" class="max-w-xs bg-primary-600 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 p-2 lg:rounded-md lg:hover:bg-primary-700" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.auth()->user()->name }}" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <main class="flex-1 relative overflow-y-auto focus:outline-none">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <div class="pb-6">
                        <h1 class="text-2xl font-heading font-bold text-gray-900">Admin Dashboard</h1>
                        <p class="mt-1 text-sm text-gray-500">Monitor and manage your platform's performance</p>
                    </div>
                    
                    <!-- Welcome Banner -->
                    <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-2xl shadow-soft mb-6">
                        <div class="p-6 sm:p-8">
                            <div class="flex flex-col md:flex-row items-center justify-between">
                                <div class="flex-1 mb-4 md:mb-0">
                                    <h2 class="text-xl font-heading font-bold text-white">Welcome back, {{ auth()->user()->name }}!</h2>
                                    <p class="mt-1 text-primary-100">Here's what's happening across your platform today.</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="inline-flex rounded-lg shadow-sm bg-white bg-opacity-20 p-2">
                                        <span class="text-white font-medium px-2">{{ now()->format('F j, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mt-4">
                        <!-- Active Stores Card -->
                        <div class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-primary-100 p-3 rounded-lg">
                                        <svg class="h-8 w-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Active Stores</dt>
                                            <dd>
                                                <div class="text-2xl font-bold text-gray-900">{{ $activeStores ?? 125 }}</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3 rounded-b-xl border-t border-gray-100">
                                <div class="text-sm">
                                    <a href="{{ route('admin.stores.index') }}" class="font-medium text-primary-600 hover:text-primary-500 flex items-center">
                                        <span>View all</span>
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Total Users Card -->
                        <div class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-accent-100 p-3 rounded-lg">
                                        <svg class="h-8 w-8 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                            <dd>
                                                <div class="text-2xl font-bold text-gray-900">{{ $totalUsers ?? 3492 }}</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3 rounded-b-xl border-t border-gray-100">
                                <div class="text-sm">
                                    <a href="{{ route('admin.users.index') }}" class="font-medium text-primary-600 hover:text-primary-500 flex items-center">
                                        <span>View all</span>
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Monthly Revenue Card -->
                        <div class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-secondary-100 p-3 rounded-lg">
                                        <svg class="h-8 w-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Monthly Revenue</dt>
                                            <dd>
                                                <div class="text-2xl font-bold text-gray-900">KES {{ $monthlyRevenue ?? '458,695.00' }}</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3 rounded-b-xl border-t border-gray-100">
                                <div class="text-sm">
                                    <a href="{{ route('admin.reports.index') }}" class="font-medium text-primary-600 hover:text-primary-500 flex items-center">
                                        <span>View reports</span>
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Withdrawals Card -->
                        <div class="bg-white overflow-hidden rounded-xl shadow-soft hover:shadow-md transition-shadow duration-300">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-primary-100 p-3 rounded-lg">
                                        <svg class="h-8 w-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Pending Withdrawals</dt>
                                            <dd>
                                                <div class="text-2xl font-bold text-gray-900">{{ $pendingWithdrawals ?? 14 }}</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3 rounded-b-xl border-t border-gray-100">
                                <div class="text-sm">
                                    <a href="{{ route('admin.withdrawals.index') }}" class="font-medium text-primary-600 hover:text-primary-500 flex items-center">
                                        <span>View all</span>
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders and New Stores -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                        <!-- Recent Orders -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-xl shadow-soft overflow-hidden">
                                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                                    <h2 class="text-lg font-heading font-medium text-gray-900">Recent Orders</h2>
                                    <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">View all</a>
                                </div>
                                <div class="divide-y divide-gray-200">
                                    @forelse($recentOrders ?? [] as $order)
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="block hover:bg-gray-50 transition-colors duration-150">
                                        <div class="px-6 py-4">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-primary-600 truncate">Order #{{ $order->id }}</p>
                                                <div class="ml-2 flex-shrink-0 flex">
                                                    <p class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $order->status }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-2 sm:flex sm:justify-between">
                                                <div class="sm:flex">
                                                    <p class="flex items-center text-sm text-gray-500">
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                        {{ $order->user->name }}
                                                    </p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                        </svg>
                                                        {{ $order->store->name }}
                                                    </p>
                                                </div>
                                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <p>KES {{ $order->total }}</p>
                                                    <p class="ml-4 text-gray-400">{{ $order->created_at->format('M d, Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @empty
                                    <div class="px-6 py-8 text-center text-gray-500">No recent orders</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- New Stores -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-xl shadow-soft overflow-hidden h-full">
                                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                                    <h2 class="text-lg font-heading font-medium text-gray-900">New Stores</h2>
                                    <a href="{{ route('admin.stores.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">View all</a>
                                </div>
                                <div class="divide-y divide-gray-200 h-full">
                                    @forelse($recentStores ?? [] as $store)
                                    <a href="{{ route('admin.stores.show', $store->id) }}" class="block hover:bg-gray-50 transition-colors duration-150">
                                        <div class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $store->logo_url ?? 'https://ui-avatars.com/api/?name='.$store->name }}" alt="{{ $store->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <h3 class="text-sm font-medium text-gray-900">{{ $store->name }}</h3>
                                                    <p class="text-xs text-gray-500 mt-1">{{ $store->owner->name }}</p>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-2">
                                                        New
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @empty
                                    <div class="px-6 py-8 text-center text-gray-500 h-full flex items-center justify-center">
                                        <div>
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            <p class="mt-2">No new stores</p>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection