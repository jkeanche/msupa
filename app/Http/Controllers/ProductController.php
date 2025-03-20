<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $supermarket = null;
        
        // For supermarket owners
        if ($user->isSupermarketOwner()) {
            $supermarket = $user->supermarket;
            
            // Check if they have an active subscription
            if (!$supermarket || !$supermarket->subscription || !$supermarket->subscription->isActive()) {
                return redirect()->route('subscriptions.plans')
                    ->with('error', 'You need an active subscription to manage products.');
            }
            
            $query = $supermarket->products();
        } 
        // For admins (viewing a specific supermarket's products)
        elseif ($user->isAdmin() && $request->has('store_id')) {
            $supermarket = Supermarket::findOrFail($request->store_id);
            $query = $supermarket->products();
        } 
        // For admins (viewing all products)
        elseif ($user->isAdmin()) {
            $query = Product::with('supermarket');
        } 
        else {
            return abort(403, 'Unauthorized action.');
        }
        
        // Apply filters
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }
        
        // Order by
        $orderBy = $request->input('order_by', 'created_at');
        $orderDir = $request->input('order_dir', 'desc');
        $query->orderBy($orderBy, $orderDir);
        
        $products = $query->paginate(20);
        
        if ($user->isSupermarketOwner()) {
            return view('owner.products.index', compact('products', 'supermarket'));
        } else {
            return view('admin.products.index', compact('products', 'supermarket'));
        }
    }
    
    public function create()
    {
        $user = Auth::user();
        
        if ($user->isSupermarketOwner()) {
            $supermarket = $user->supermarket;
            
            // Check if they have an active subscription
            if (!$supermarket || !$supermarket->subscription || !$supermarket->subscription->isActive()) {
                return redirect()->route('subscriptions.plans')
                    ->with('error', 'You need an active subscription to add products.');
            }
            
            // Check if they've reached their product limit
            $plan = $supermarket->subscription->plan;
            $productCount = $supermarket->products()->count();
            
            if ($productCount >= $plan->product_limit) {
                return redirect()->route('owner.products.index')
                    ->with('error', "You've reached your product limit ({$plan->product_limit}). Please upgrade your plan.");
            }
            
            $categories = $supermarket->categories()->active()->get();
            return view('owner.products.create', compact('categories', 'supermarket'));
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isSupermarketOwner()) {
            return abort(403, 'Unauthorized action.');
        }
        
        $supermarket = $user->supermarket;
        
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:100',
            'weight' => 'nullable|numeric|min:0',
            'weight_unit' => 'nullable|string|max:10',
            'dimensions' => 'nullable|string|max:100',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'featured_until' => 'nullable|date|after:today',
        ]);
        
        // Process tags
        $tags = [];
        if (!empty($validated['tags'])) {
            $tags = explode(',', $validated['tags']);
            $tags = array_map('trim', $tags);
        }
        $validated['tags'] = $tags;
        
        // Process images
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = $path;
            }
        }
        $validated['images'] = $images;
        
        // Create slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        // Set store_id
        $validated['store_id'] = $supermarket->id;
        
        // Create the product
        $product = Product::create($validated);
        
        return redirect()->route('owner.products.index')
            ->with('success', 'Product created successfully!');
    }
    
    // Other methods (edit, update, destroy) would follow similar patterns
}