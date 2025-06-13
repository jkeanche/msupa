<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    public function index()
    {
        return view('admin.featured.index');
    }

    public function create()
    {
        return view('admin.featured.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('admin.featured.index')->with('success', 'Featured product created successfully');
    }

    public function show($id)
    {
        return view('admin.featured.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.featured.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('admin.featured.index')->with('success', 'Featured product updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('admin.featured.index')->with('success', 'Featured product deleted successfully');
    }
}
