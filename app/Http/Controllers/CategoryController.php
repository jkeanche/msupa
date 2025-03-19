<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supermarket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // For supermarket owners
        if ($user->isSupermarketOwner()) {
            $supermarket = $user->supermarket;
            
            // Check if they have an active subscription
            if (!$supermarket || !$supermarket->subscription || !$supermarket->subscription->isActive()) {
                return redirect()->route('subscriptions.plans')
                    ->with('error', 'You need an active subscription to manage categories.');
            }
            
            $categories = $supermarket->categories()->withCount('products')->orderBy('display_order')->get();
            return view('owner.categories.index', compact('categories', 'supermarket'));
        } 
        // For admins
        elseif ($user->isAdmin() && $request->has('supermarket_id')) {
            $supermarket = Supermarket::findOrFail($request->supermarket_id);
            $categories = $supermarket->categories()->withCount('products')->orderBy('display_order')->get();
            return view('admin.categories.index', compact('categories', 'supermarket'));
        } 
        // For admins viewing all
        elseif ($user->isAdmin()) {
            $categories = Category::with('supermarket')->withCount('products')->paginate(20);
            return view('admin.categories.index', compact('categories'));
        } 
        else {
            return abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $user = Auth::user();
        
        if ($user->isSupermarketOwner()) {
            $supermarket = $user->supermarket;
            
            // Check if they have an active subscription
            if (!$supermarket || !$supermarket->subscription || !$supermarket->subscription->isActive()) {
                return redirect()->route('subscriptions.plans')
                    ->with('error', 'You need an active subscription to add categories.');
            }
            
            $parentCategories = $supermarket->categories()->whereNull('parent_id')->get();
            return view('owner.categories.create', compact('parentCategories'));
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isSupermarketOwner()) {
            return abort(403, 'Unauthorized action.');
        }
        
        $supermarket = $user->supermarket;
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);
        
        // Create slug
        $validated['slug'] = Str::slug($validated['name']);
        
        // Check if slug exists for this supermarket
        $slugExists = $supermarket->categories()
            ->where('slug', $validated['slug'])
            ->exists();
            
        if ($slugExists) {
            $validated['slug'] = $validated['slug'] . '-' . time();
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }
        
        // Set supermarket_id
        $validated['supermarket_id'] = $supermarket->id;
        
        // Create category
        Category::create($validated);
        
        return redirect()->route('owner.categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        $user = Auth::user();
        $supermarket = $category->supermarket;
        
        // Public view for customers (if category is active)
        if ($category->is_active && $supermarket->is_active) {
            $products = $category->products()
                ->where('is_active', true)
                ->paginate(16);
                
            return view('categories.show', compact('category', 'products', 'supermarket'));
        }
        
        // Owner view
        if ($user->isSupermarketOwner() && $user->supermarket && $user->supermarket->id === $supermarket->id) {
            $products = $category->products()->paginate(20);
            return view('owner.categories.show', compact('category', 'products'));
        }
        
        // Admin view
        if ($user->isAdmin()) {
            $products = $category->products()->paginate(20);
            return view('admin.categories.show', compact('category', 'products'));
        }
        
        return abort(404);
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        $user = Auth::user();
        
        // Owner edit view
        if ($user->isSupermarketOwner() && $user->supermarket && 
            $user->supermarket->id === $category->supermarket_id) {
                
            $parentCategories = $user->supermarket->categories()
                ->where('id', '!=', $category->id)
                ->whereNull('parent_id')
                ->get();
                
            return view('owner.categories.edit', compact('category', 'parentCategories'));
        }
        
        // Admin edit view
        if ($user->isAdmin()) {
            $parentCategories = $category->supermarket->categories()
                ->where('id', '!=', $category->id)
                ->whereNull('parent_id')
                ->get();
                
            return view('admin.categories.edit', compact('category', 'parentCategories'));
        }
        
        return abort(403, 'Unauthorized action.');
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $user = Auth::user();
        
        // Check authorization
        if (!($user->isAdmin() || 
            ($user->isSupermarketOwner() && $user->supermarket && 
             $user->supermarket->id === $category->supermarket_id))) {
            return abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);
        
        // Check parent_id is not the category itself
        if (isset($validated['parent_id']) && $validated['parent_id'] == $category->id) {
            return back()->withErrors(['parent_id' => 'A category cannot be its own parent.']);
        }
        
        // Update slug if name changed
        if ($category->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
            
            // Check if slug exists for this supermarket
            $slugExists = $category->supermarket->categories()
                ->where('slug', $validated['slug'])
                ->where('id', '!=', $category->id)
                ->exists();
                
            if ($slugExists) {
                $validated['slug'] = $validated['slug'] . '-' . time();
            }
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }
        
        $category->update($validated);
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.categories.index', ['supermarket_id' => $category->supermarket_id])
                ->with('success', 'Category updated successfully!');
        } else {
            return redirect()->route('owner.categories.index')
                ->with('success', 'Category updated successfully!');
        }
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        $user = Auth::user();
        
        // Check authorization
        if (!($user->isAdmin() || 
            ($user->isSupermarketOwner() && $user->supermarket && 
             $user->supermarket->id === $category->supermarket_id))) {
            return abort(403, 'Unauthorized action.');
        }
        
        // Check if category has products
        if ($category->products()->exists()) {
            return back()->withErrors(['error' => 'Cannot delete category with products. Move or delete the products first.']);
        }
        
        // Delete image if exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        
        $category->delete();
        
        return back()->with('success', 'Category deleted successfully!');
    }
    
    /**
     * Reorder categories using AJAX
     */
    public function reorder(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isSupermarketOwner()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);
        
        $supermarket = $user->supermarket;
        
        foreach ($request->categories as $index => $id) {
            $category = Category::find($id);
            
            // Ensure the category belongs to the user's supermarket
            if ($category && $category->supermarket_id === $supermarket->id) {
                $category->display_order = $index;
                $category->save();
            }
        }
        
        return response()->json(['success' => true]);
    }
}
