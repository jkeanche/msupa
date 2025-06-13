<!-- filepath: c:\xampp\htdocs\msupa\resources\views\layouts\admin.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'm-Supa') }} - Admin</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
 
     <!-- Scripts -->
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
        // Initialize components or features specific to admin
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
                                data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 29000, 32000, 35000, 40000, 42000],
                                backgroundColor: 'rgba(79, 70, 229, 0.2)',
                                borderColor: 'rgba(79, 70, 229, 1)',
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
                
                // Revenue chart
                const revenueChartElement = document.getElementById('revenueChart');
                if (revenueChartElement) {
                    const revenueChart = new Chart(revenueChartElement, {
                        type: 'bar',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            datasets: [{
                                label: 'Revenue',
                                data: [50000, 60000, 55000, 65000, 70000, 80000],
                                backgroundColor: 'rgba(79, 70, 229, 0.6)'
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
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>