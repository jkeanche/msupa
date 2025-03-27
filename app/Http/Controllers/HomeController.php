<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;

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
        // Fetch active banners
        $banners = Banner::active()->orderBy('position')->take(3)->get();
        
        // Fetch featured stores
        $featuredStores = Store::where('is_featured', true)
            ->take(6)
            ->get();
            
        // Fetch featured products
        $featuredProducts = Product::where('is_featured', true)
            ->with(['store', 'category'])
            ->take(8)
            ->get();
            
        // Fetch new arrivals
        $newArrivals = Product::orderBy('created_at', 'desc')
            ->with(['store', 'category'])
            ->take(4)
            ->get();
            
        // Fetch categories for filtering
        $categories = Category::take(6)->get();
        
        return view('index', compact(
            'banners',
            'featuredStores', 
            'featuredProducts', 
            'newArrivals',
            'categories'
        ));
    }
}
