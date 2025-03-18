<?php

namespace App\Http\Controllers;

use App\Models\ProductAttributeValue;
use App\Models\ProductAttribute;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributeValues = ProductAttributeValue::with(['product', 'attribute'])->paginate(10);
        return view('product-attribute-values.index', compact('attributeValues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $attributes = ProductAttribute::all();
        return view('product-attribute-values.create', compact('products', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_attribute_id' => 'required|exists:product_attributes,id',
            'value' => 'required|string|max:255',
        ]);

        ProductAttributeValue::create($validated);

        return redirect()->route('product-attribute-values.index')
            ->with('success', 'Product attribute value created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAttributeValue $productAttributeValue)
    {
        return view('product-attribute-values.show', compact('productAttributeValue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAttributeValue $productAttributeValue)
    {
        $products = Product::all();
        $attributes = ProductAttribute::all();
        return view('product-attribute-values.edit', compact('productAttributeValue', 'products', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductAttributeValue $productAttributeValue)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_attribute_id' => 'required|exists:product_attributes,id',
            'value' => 'required|string|max:255',
        ]);

        $productAttributeValue->update($validated);

        return redirect()->route('product-attribute-values.index')
            ->with('success', 'Product attribute value updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAttributeValue $productAttributeValue)
    {
        $productAttributeValue->delete();

        return redirect()->route('product-attribute-values.index')
            ->with('success', 'Product attribute value deleted successfully.');
    }
}
