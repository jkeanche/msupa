<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Welcome to {{ config('app.name', 'Laravel') }}</h1>
        </div>
    </header>
    
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="border-4 border-dashed border-gray-200 rounded-lg p-4 flex flex-col justify-center items-center" style="min-height: 400px; background-color: #f7fafc;">
                    <h2 class="text-2xl mb-4 text-blue-600">Home Page Content</h2>
                    <p class="text-gray-700 text-lg mb-4">This is the updated home page content. If you can see this, the view is working correctly.</p>
                    <div class="bg-yellow-100 p-4 rounded-lg border border-yellow-300 mb-4">
                        <p class="text-yellow-800">Current time: {{ date('Y-m-d H:i:s') }}</p>
                    </div>
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Sample Button
                    </a>
                </div>
            </div>
        </div>
    </main>
    
    <footer class="bg-white shadow mt-8 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
