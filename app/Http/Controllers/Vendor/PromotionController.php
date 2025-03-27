<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        return view('vendor.promotions.index');
    }

    public function create()
    {
        return view('vendor.promotions.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('vendor.promotions.index')->with('success', 'Promotion created successfully');
    }

    public function show($id)
    {
        return view('vendor.promotions.show', compact('id'));
    }

    public function edit($id)
    {
        return view('vendor.promotions.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('vendor.promotions.index')->with('success', 'Promotion updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('vendor.promotions.index')->with('success', 'Promotion deleted successfully');
    }
}
