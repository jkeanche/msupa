<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    
    public function index()
    {
        $images = ProductImage::all();
        return view('product_images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Show the form for creating a new product image.
     */
    public function create()
    {
        return view('product_images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image' => 'required|image|max:2048', // 2MB max
        ]);

        $path = $request->file('image')->store('product_images', 'public');

        $productImage = new ProductImage();
        $productImage->product_id = $request->product_id;
        $productImage->image_path = $path;
        $productImage->save();

        return redirect()->route('product_images.index')
            ->with('success', 'Product image uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductImage $productImage)
    {
        return view('product_images.show', compact('productImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImage $productImage)
    {
        return view('product_images.edit', compact('productImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImage $productImage)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image' => 'nullable|image|max:2048', // 2MB max
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($productImage->image_path) {
                Storage::disk('public')->delete($productImage->image_path);
            }
            // Store new image
            $path = $request->file('image')->store('product_images', 'public');
            $productImage->image_path = $path;
        }

        $productImage->product_id = $request->product_id;
        $productImage->save();

        return redirect()->route('product_images.index')
            ->with('success', 'Product image updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImage $productImage)
    {
        // Delete the image file from storage
        if ($productImage->image_path) {
            Storage::disk('public')->delete($productImage->image_path);
        }
        
        // Delete the record
        $productImage->delete();

        return redirect()->route('product_images.index')
            ->with('success', 'Product image deleted successfully');
    }
}
