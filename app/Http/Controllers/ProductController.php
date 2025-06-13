<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 'active')->with(['store', 'images', 'category']);
        
        // Apply filters
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Sort
        $sort = $request->sort ?? 'latest';
        
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            default:
                $query->latest();
        }
        
        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();
        // Or using the active scope defined in the Category model:
        // $categories = Category::active()->get();
        
        return view('admin.products.index', compact('products', 'categories'));
    }
    
    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::active()->get();
        $stores = Store::where('is_active', true)->get();
        
        return view('admin.products.create', compact('categories', 'stores'));
    }
    
    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:regular_price',
            'sku' => 'nullable|string|unique:products,sku',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
            'status' => 'required|in:active,inactive,draft',
            'image_url' => 'nullable|url',
            'is_featured' => 'boolean'
        ]);
        
        $productData = $request->all();
        $productData['slug'] = Str::slug($request->name);
        $productData['is_featured'] = $request->has('is_featured');
        
        $product = Product::create($productData);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }
    
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $product->load(['store', 'images', 'category']);
            
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->with(['store', 'images'])
            ->inRandomOrder()
            ->take(4)
            ->get();

      
            
        return view('admin.products.show', compact('product', 'relatedProducts'));
    }
    
    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        $stores = Store::where('is_active', true)->get();
        
        return view('admin.products.edit', compact('product', 'categories', 'stores'));
    }
    
    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:regular_price',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
            'status' => 'required|in:active,inactive,draft',
            'image_url' => 'nullable|url',
            'is_featured' => 'boolean'
        ]);
        
        $productData = $request->all();
        $productData['slug'] = Str::slug($request->name);
        $productData['is_featured'] = $request->has('is_featured');
        
        $product->update($productData);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }
    
    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}