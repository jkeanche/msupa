<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Public landing page - no auth middleware required
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch featured stores
        $featuredStores = Store::where('is_featured', true)
            ->take(6)
            ->get();
            
        // Fetch featured products
        $featuredProducts = Product::where('is_featured', true)
            ->with('store')
            ->take(8)
            ->get();
            
        // Fetch categories for filtering
        $categories = Category::all();
        
        return view('home', compact('featuredStores', 'featuredProducts', 'categories'));
    }
}
