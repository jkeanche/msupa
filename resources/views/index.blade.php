<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'M-Supa') }}</title>
    
    <!-- Using CDN for styling instead of Vite -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-200">
    @include('partials.header')
    
    <main>
        @include('partials.hero')
        <!-- Banners Section -->
        <div class="my-6 ">
            @include('components.banners')
        </div>

        <!-- Hero Section -->
        @include('partials.welcome')
        @include('components.category-grid', ['categories' => $categories])
        @include('components.product-grid', ['id' => 'newArrivals', 'products' => $newArrivals, 'title' => 'Newly Listed', 'description' => 'Check out our new products that are trending this week.'])
        @include('components.product-grid', ['id' => 'featured', 'products' => $featuredProducts, 'title' => 'Featured Products', 'description' => 'Check out our featured products that are trending this week.'])
        @include('components.store-grid',['stores' => $featuredStores, 'title' => 'Top Stores', 'description' => 'Discover the top stores offering the best deals and products.'])
        @include('components.how-it-works')
        <!-- Features Section -->
        @include('partials.services')
        
        <!-- About Section -->
        @include('partials.about')
        
        <!-- Call to Action -->
        @include('partials.cta')

        <!-- Customer Reviews -->
        @include('partials.reviews')

        <!-- App Download -->
        @include('partials.app-download')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Shopping Cart Slide-Out -->
    @include('partials.cart')

    <!-- Simple JS to toggle cart -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartButton = document.querySelector('a[aria-label="View cart"]');
            const cartPanel = document.getElementById('shopping-cart');
            const closeButton = cartPanel.querySelector('button');

            if (cartButton) {
                cartButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    cartPanel.classList.remove('hidden');
                });
            }

            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    cartPanel.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
