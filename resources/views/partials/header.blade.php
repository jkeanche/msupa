<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md shadow-md transition-all duration-300">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Logo and Brand -->
            <div class="flex items-center space-x-2">
                <div class="text-blue-600 w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center transform transition duration-500 hover:rotate-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-700">
                    M-Supa
                </h1>
            </div>
            
            <!-- Navigation - Desktop -->
            <nav class="hidden md:block">
                <ul class="flex space-x-1">
                    <li>
                        <a href="/" class="relative px-4 py-2 text-blue-600 font-medium rounded-lg flex items-center transition-all duration-300 hover:bg-blue-50 group">
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#about" class="relative px-4 py-2 text-gray-700 font-medium rounded-lg flex items-center transition-all duration-300 hover:bg-blue-50 group">
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                            About
                        </a>
                    </li>
                    <li>
                        <a href="#features" class="relative px-4 py-2 text-gray-700 font-medium rounded-lg flex items-center transition-all duration-300 hover:bg-blue-50 group">
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                            Features
                        </a>
                    </li>
                    <li>
                        <a href="#testimonials" class="relative px-4 py-2 text-gray-700 font-medium rounded-lg flex items-center transition-all duration-300 hover:bg-blue-50 group">
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                            Testimonials
                        </a>
                    </li>
                    <li>
                        <a href="#contact" class="relative px-4 py-2 text-gray-700 font-medium rounded-lg flex items-center transition-all duration-300 hover:bg-blue-50 group">
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                            Contact
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- Right side actions -->
            <div class="flex items-center space-x-2">
                
                
                <!-- User indicator -->

                @if(auth()->check())
                <div class="hidden md:flex bg-blue-50 px-3 py-1 rounded-full items-center text-xs text-blue-600 font-medium mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>{{auth()->user()->name}}</span>
                </div>
                @endif
                
                <!-- Login/Signup buttons -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') ?? '#' }}" class="relative inline-flex items-center justify-center px-4 py-2 overflow-hidden font-medium text-blue-600 transition duration-300 ease-out border border-blue-600 rounded-lg shadow-md group">
                        <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-gradient-to-r from-blue-600 to-indigo-700 group-hover:translate-x-0 ease">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </span>
                        <span class="absolute flex items-center justify-center w-full h-full text-blue-600 transition-all duration-300 transform group-hover:translate-x-full ease">Login</span>
                        <span class="relative invisible">Login</span>
                    </a>
                    <a href="{{ route('register') ?? '#' }}" class="relative inline-flex items-center justify-center px-4 py-2 overflow-hidden font-medium text-white transition duration-300 ease-out rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-indigo-700 group">
                        <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent to-transparent"></span>
                        <span class="relative flex items-center">
                            Sign Up
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 transform transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <button type="button" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-blue-50 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu, show/hide based on menu state -->
    <div class="md:hidden bg-white border-t border-gray-100 shadow-inner" id="mobile-menu" style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="text-blue-600 font-medium block px-3 py-2 rounded-md">Home</a>
            <a href="#about" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block px-3 py-2 rounded-md font-medium">About</a>
            <a href="#features" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block px-3 py-2 rounded-md font-medium">Features</a>
            <a href="#testimonials" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block px-3 py-2 rounded-md font-medium">Testimonials</a>
            <a href="#contact" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block px-3 py-2 rounded-md font-medium">Contact</a>
            <div class="pt-4 pb-3 border-t border-gray-100 mt-4">
                <div class="flex items-center text-sm text-gray-500 px-3 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>@jkeanche</span>
                </div>
                <div class="flex items-center text-sm text-gray-500 px-3 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    
                </div>
            </div>
        </div>
    </div>
</header>