<!-- filepath: c:\xampp\htdocs\msupa\resources\views\layouts\vendor.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'm-Supa') }} - Vendor Portal</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    @vite(['resources/css/app.css','resources/css/animation.css', 'resources/js/app.js'])
    
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
    
    @livewireScripts
    
    <!-- Additional Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    
    <script>
        // Initialize components or features specific to vendor
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const menuButton = document.querySelector('[data-mobile-menu-button]');
            const sidebar = document.querySelector('[data-sidebar]');
            
            if (menuButton && sidebar) {
                menuButton.addEventListener('click', function() {
                    sidebar.classList.toggle('hidden');
                });
            }
            
            // Initialize charts if they exist
            if (typeof Chart !== 'undefined') {
                // Sales chart
                const salesChartElement = document.getElementById('salesChart');
                if (salesChartElement) {
                    const salesChart = new Chart(salesChartElement, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                label: 'Monthly Sales',
                                data: [1200, 1900, 1500, 2500, 2200, 3000, 2800, 2900, 3200, 3500, 4000, 4200],
                                backgroundColor: 'rgba(16, 185, 129, 0.2)',
                                borderColor: 'rgba(16, 185, 129, 1)',
                                borderWidth: 2,
                                tension: 0.3
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
                
                // Products chart
                const productsChartElement = document.getElementById('productsChart');
                if (productsChartElement) {
                    const productsChart = new Chart(productsChartElement, {
                        type: 'doughnut',
                        data: {
                            labels: ['Electronics', 'Groceries', 'Fashion', 'Home', 'Beauty'],
                            datasets: [{
                                data: [30, 40, 15, 10, 5],
                                backgroundColor: [
                                    'rgba(16, 185, 129, 0.8)',
                                    'rgba(59, 130, 246, 0.8)',
                                    'rgba(245, 158, 11, 0.8)',
                                    'rgba(239, 68, 68, 0.8)',
                                    'rgba(139, 92, 246, 0.8)'
                                ]
                            }]
                        }
                    });
                }
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>