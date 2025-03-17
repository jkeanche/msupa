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
    public function index()
    {
        $store = Auth::user()->store;
        $products = Product::where('store_id', $store->id)
            ->with('category')
            ->latest()
            ->paginate(10);
            
        return view('vendor.products.index', compact('products'));
    }
    
    public function create()
    {
        $categories = Category::where('status', true)->get();
        return view('vendor.products.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $store = Auth::user()->store;
        
        $product = new Product();
        $product->store_id = $store->id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name) . '-' . Str::random(5);
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->stock_quantity = $request->stock_quantity;
        $product->sku = $request->sku ?? Str::upper(Str::random(8));
        $product->featured = $request->has('featured');
        $product->status = $request->status ?? 'draft';
        $product->save();
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $path;
                $productImage->is_primary = $index === 0; // First image is primary
                $productImage->save();
            }
        }
        
        return redirect()->route('vendor.products.index')->with('success', 'Product created successfully.');
    }
    
    // Other methods (edit, update, destroy) would follow similar patterns
}