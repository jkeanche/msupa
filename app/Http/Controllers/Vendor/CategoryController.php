<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('vendor.categories.index');
    }

    public function create()
    {
        return view('vendor.categories.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('vendor.categories.index')->with('success', 'Category created successfully');
    }

    public function show($id)
    {
        return view('vendor.categories.show', compact('id'));
    }

    public function edit($id)
    {
        return view('vendor.categories.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('vendor.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('vendor.categories.index')->with('success', 'Category deleted successfully');
    }
}
