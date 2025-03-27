<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        return view('admin.promotions.index');
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('admin.promotions.index')->with('success', 'Promotion created successfully');
    }

    public function show($id)
    {
        return view('admin.promotions.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.promotions.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('admin.promotions.index')->with('success', 'Promotion updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('admin.promotions.index')->with('success', 'Promotion deleted successfully');
    }
}
