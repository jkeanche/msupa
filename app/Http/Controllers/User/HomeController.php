<?php


// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('featured', true)
            ->where('status', 'active')
            ->with(['store', 'images'])
            ->take(8)
            ->get();
            
        $newArrivals = Product::where('status', 'active')
            ->with(['store', 'images'])
            ->latest()
            ->take(8)
            ->get();
            
        $categories = Category::where('status', true)
            ->whereNull('parent_id')
            ->with('children')
            ->get();
            
        $banners = Banner::where('status', true)
            ->where('position', 'home')
            ->whereDate('starts_at', '<=', now())
            ->whereDate('ends_at', '>=', now())
            ->get();
            
        return view('home', compact('featuredProducts', 'newArrivals', 'categories', 'banners'));
    }
}
