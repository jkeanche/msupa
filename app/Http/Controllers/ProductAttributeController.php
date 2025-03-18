<?php

namespace App\Http\Controllers;

use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = ProductAttribute::all();
        return view('product-attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product-attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_attributes',
            'values' => 'nullable|string',
            'type' => 'required|string|in:select,radio,checkbox,text,textarea',
        ]);

        ProductAttribute::create($validated);

        return redirect()->route('product-attributes.index')
            ->with('success', 'Product attribute created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAttribute $productAttribute)
    {
        return view('product-attributes.show', compact('productAttribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAttribute $productAttribute)
    {
        return view('product-attributes.edit', compact('productAttribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductAttribute $productAttribute)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_attributes,name,' . $productAttribute->id,
            'values' => 'nullable|string',
            'type' => 'required|string|in:select,radio,checkbox,text,textarea',
        ]);

        $productAttribute->update($validated);

        return redirect()->route('product-attributes.index')
            ->with('success', 'Product attribute updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAttribute $productAttribute)
    {
        $productAttribute->delete();

        return redirect()->route('product-attributes.index')
            ->with('success', 'Product attribute deleted successfully.');
    }
}
