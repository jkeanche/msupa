<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Confirm Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-gray-900">{{ config('app.name', 'Laravel') }}</h1>
                <p class="mt-2 text-sm text-gray-600">Please confirm your password before continuing</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="mb-4 text-sm text-gray-600">
                    This is a secure area of the application. Please confirm your password before continuing.
                </div>
                
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" type="password" class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Confirm Password
                        </button>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <div class="mt-4 text-center">
                            <a class="text-sm text-indigo-600 hover:text-indigo-800" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
            
            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:text-indigo-800">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>
