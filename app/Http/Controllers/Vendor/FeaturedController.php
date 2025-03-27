<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    public function index()
    {
        return view('vendor.featured.index');
    }

    public function create()
    {
        return view('vendor.featured.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('vendor.featured.index')->with('success', 'Featured product created successfully');
    }

    public function show($id)
    {
        return view('vendor.featured.show', compact('id'));
    }

    public function edit($id)
    {
        return view('vendor.featured.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('vendor.featured.index')->with('success', 'Featured product updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('vendor.featured.index')->with('success', 'Featured product deleted successfully');
    }
}
