<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Using CDN for styling instead of Vite -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">{{ config('app.name', 'Laravel') }}</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="/" class="text-blue-600 hover:text-blue-800">Home</a></li>
                    <li><a href="#about" class="text-gray-600 hover:text-gray-800">About</a></li>
                    <li><a href="#services" class="text-gray-600 hover:text-gray-800">Services</a></li>
                    <li><a href="#contact" class="text-gray-600 hover:text-gray-800">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main>
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-xl rounded-lg overflow-hidden">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <h2 class="text-5xl font-extrabold mb-6 text-center animate__animated animate__fadeInDown">
            Welcome to <span class="text-yellow-300">M-Supa</span>
        </h2>
        <p class="text-xl mb-10 text-center max-w-3xl leading-relaxed animate__animated animate__fadeIn animate__delay-1s">
            The premier marketplace where vendors and customers connect seamlessly. 
            Discover extraordinary products, build valuable relationships, and grow your business in one powerful platform.
        </p>
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 animate__animated animate__fadeInUp animate__delay-2s">
            <a href="{{route('login')}}" class="bg-white text-blue-700 px-8 py-4 rounded-lg font-bold hover:bg-yellow-100 transition duration-300 transform hover:scale-105 hover:shadow-lg text-center">
                Get Started
            </a>
            <a href="#learn-more" class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-blue-500 transition duration-300 transform hover:scale-105 hover:shadow-lg text-center">
                Learn More
            </a>
        </div>
    </div>
</div>
        
        <!-- Features Section -->
        <div id="services" class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fast Performance</h3>
                    <p class="text-gray-600">Our platform is optimized for speed and efficiency, ensuring you get the best experience.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Secure & Reliable</h3>
                    <p class="text-gray-600">Your data is protected with the latest security measures, giving you peace of mind.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Cloud Integration</h3>
                    <p class="text-gray-600">Seamlessly connect with your existing cloud services for maximum productivity.</p>
                </div>
            </div>
        </div>
        
        <!-- About Section -->
        <div id="about" class="bg-gray-50 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="lg:w-1/2">
                        <h2 class="text-3xl font-bold mb-4">About Us</h2>
                        <p class="text-gray-600 mb-6">We are dedicated to providing high-quality solutions that meet your needs. With years of experience in the industry, our team of experts is committed to excellence in every project.</p>
                        <p class="text-gray-600 mb-6">Our mission is to empower businesses and individuals with innovative technology that makes life better and work more efficient.</p>
                        <a href="#learn-more" class="text-blue-600 font-semibold hover:text-blue-800">Learn more about our story →</a>
                    </div>
                    <div class="mt-10 lg:mt-0 lg:w-1/2">
                        <div class="bg-blue-600 rounded-lg p-8 text-white">
                            <h3 class="text-2xl font-bold mb-4">Our Vision</h3>
                            <p class="mb-4">To revolutionize the industry with cutting-edge solutions that address real-world challenges.</p>
                            <h3 class="text-2xl font-bold mb-4">Our Values</h3>
                            <ul class="list-disc list-inside space-y-2">
                                <li>Innovation and excellence</li>
                                <li>Customer satisfaction</li>
                                <li>Integrity and transparency</li>
                                <li>Continuous improvement</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Call to Action -->
        <div id="contact" class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-blue-50 rounded-lg p-8 shadow-md">
                <h2 class="text-3xl font-bold text-center mb-6">Ready to Get Started?</h2>
                <p class="text-center text-gray-600 mb-8 max-w-3xl mx-auto">Join thousands of satisfied customers who have transformed their business with our solutions.</p>
                <div class="text-center">
                    <a href="#contact-us" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700">Contact Us Today</a>
                </div>
            </div>
        </div>

        <!-- Customer Reviews -->
        <div class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900">What Our Customers Say</h2>
                    <p class="mt-4 text-lg text-gray-500">Don't just take our word for it, read from our customers</p>
                </div>
                <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center">
                                    <span class="text-white font-bold">JM</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Jane Mutura</h3>
                                <div class="flex text-yellow-400 mt-1">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-gray-600">
                            <p>"I love how easy it is to compare prices across different supermarkets. This app has saved me so much time and money!"</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-green-600 flex items-center justify-center">
                                    <span class="text-white font-bold">DK</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">David Kamau</h3>
                                <div class="flex text-yellow-400 mt-1">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-gray-600">
                            <p>"The delivery is incredibly fast and the products are always fresh. Exactly what I needed for my busy lifestyle."</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-purple-600 flex items-center justify-center">
                                    <span class="text-white font-bold">SW</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Sarah Wanjiku</h3>
                                <div class="flex text-yellow-400 mt-1">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-gray-600">
                            <p>"Their customer service is exceptional. Had an issue with my order and it was resolved immediately. Highly recommend!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- App Download -->
        <div class="bg-indigo-50 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="lg:w-1/2">
                        <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Get the MSUPA App</h2>
                        <p class="mt-3 max-w-md text-lg text-gray-500">Download our mobile app for an even better shopping experience. Shop anywhere, anytime.</p>
                        <div class="mt-8 flex space-x-4">
                            <a href="#" class="inline-block bg-black text-white rounded-lg px-6 py-2 flex items-center hover:bg-gray-800">
                                <i class="fab fa-apple text-2xl mr-2"></i>
                                <div>
                                    <div class="text-xs">Download on the</div>
                                    <div class="text-sm font-semibold">App Store</div>
                                </div>
                            </a>
                            <a href="#" class="inline-block bg-black text-white rounded-lg px-6 py-2 flex items-center hover:bg-gray-800">
                                <i class="fab fa-google-play text-2xl mr-2"></i>
                                <div>
                                    <div class="text-xs">Get it on</div>
                                    <div class="text-sm font-semibold">Google Play</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="mt-10 lg:mt-0 lg:w-1/2 flex justify-center">
                        <img src="https://images.unsplash.com/photo-1511385348-a52b4a160dc2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="Mobile app" class="h-72 w-auto object-cover rounded-lg shadow-md">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <h3 class="text-xl font-bold text-indigo-600">MSUPA</h3>
                    <p class="text-gray-500 text-base">Making grocery shopping easy, fast, and affordable for everyone in Kenya.</p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Solutions</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Grocery Delivery</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Price Comparison</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Supermarket Partners</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Business Solutions</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Support</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Help Center</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Contact Us</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">FAQs</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Delivery Information</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Company</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">About</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Blog</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Careers</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Press</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Legal</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Privacy Policy</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Terms of Service</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Cookie Policy</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Data Protection</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-200 pt-8">
                <p class="text-base text-gray-400 xl:text-center">&copy; {{ date('Y') }} MSUPA. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Shopping Cart Slide-Out -->
    <div class="fixed inset-0 overflow-hidden z-50 hidden" id="shopping-cart">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
                <div class="w-screen max-w-md">
                    <div class="h-full flex flex-col bg-white shadow-xl overflow-y-scroll">
                        <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900">Shopping cart</h2>
                                <div class="ml-3 h-7 flex items-center">
                                    <button type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <span class="sr-only">Close panel</span>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-8">
                                <div class="flow-root">
                                    <ul role="list" class="-my-6 divide-y divide-gray-200">
                                        <li class="py-6 flex">
                                            <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" alt="Fresh Salad" class="w-full h-full object-center object-cover">
                                            </div>
                                            <div class="ml-4 flex-1 flex flex-col">
                                                <div>
                                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                                        <h3>Fresh Vegetable Salad</h3>
                                                        <p class="ml-4">KSh 350</p>
                                                    </div>
                                                    <p class="mt-1 text-sm text-gray-500">Naivas Supermarket</p>
                                                </div>
                                                <div class="flex-1 flex items-end justify-between text-sm">
                                                    <div class="flex items-center">
                                                        <button class="text-gray-400 hover:text-gray-500">
                                                            <i class="fas fa-minus-circle"></i>
                                                        </button>
                                                        <span class="mx-2 text-gray-700">1</span>
                                                        <button class="text-gray-400 hover:text-gray-500">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </button>
                                                    </div>
                                                    <div class="flex">
                                                        <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        <li class="py-6 flex">
                                            <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                                <img src="https://images.unsplash.com/photo-1563636619-e9143da7973b" alt="Milk" class="w-full h-full object-center object-cover">
                                            </div>
                                            <div class="ml-4 flex-1 flex flex-col">
                                                <div>
                                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                                        <h3>Fresh Milk 1L</h3>
                                                        <p class="ml-4">KSh 120</p>
                                                    </div>
                                                    <p class="mt-1 text-sm text-gray-500">QuickMart</p>
                                                </div>
                                                <div class="flex-1 flex items-end justify-between text-sm">
                                                    <div class="flex items-center">
                                                        <button class="text-gray-400 hover:text-gray-500">
                                                            <i class="fas fa-minus-circle"></i>
                                                        </button>
                                                        <span class="mx-2 text-gray-700">2</span>
                                                        <button class="text-gray-400 hover:text-gray-500">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </button>
                                                    </div>
                                                    <div class="flex">
                                                        <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Subtotal</p>
                                <p>KSh 590</p>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500 mt-1">
                                <p>Delivery Fee</p>
                                <p>KSh 150</p>
                            </div>
                            <div class="flex justify-between text-base font-medium text-gray-900 mt-4">
                                <p>Total</p>
                                <p>KSh 740</p>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                            <div class="mt-6">
                                <a href="#" class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                    Checkout
                                </a>
                            </div>
                            <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
                                <p>
                                    or <button type="button" class="text-indigo-600 font-medium hover:text-indigo-500">Continue Shopping<span aria-hidden="true"> &rarr;</span></button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
