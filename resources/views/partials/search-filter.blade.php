<form action="{{ route('products.search') }}" method="GET">
    <div class="flex flex-col md:flex-row items-center gap-4">
        <div class="w-full md:w-2/3">
            <div class="flex items-center bg-gray-100 rounded-lg overflow-hidden">
                <div class="pl-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" name="search" placeholder="Search for products, brands or categories..." class="w-full p-3 bg-gray-100 focus:outline-none" value="{{ request('search') }}">
            </div>
        </div>
        
        <div class="w-full md:w-1/3">
            <select name="category" class="w-full p-3 bg-gray-100 rounded-lg focus:outline-none">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-medium transition">
            Search
        </button>
    </div>
    
    <div class="mt-4 flex flex-wrap items-center gap-3">
        <span class="text-gray-500">Popular:</span>
        <a href="{{ route('products.search', ['search' => 'milk']) }}" class="text-sm bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-full text-gray-700">Milk</a>
        <a href="{{ route('products.search', ['search' => 'bread']) }}" class="text-sm bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-full text-gray-700">Bread</a>
        <a href="{{ route('products.search', ['search' => 'fruits']) }}" class="text-sm bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-full text-gray-700">Fruits</a>
        <a href="{{ route('products.search', ['search' => 'vegetables']) }}" class="text-sm bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-full text-gray-700">Vegetables</a>
        <a href="{{ route('products.search', ['search' => 'meat']) }}" class="text-sm bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-full text-gray-700">Meat</a>
    </div>
</form>
