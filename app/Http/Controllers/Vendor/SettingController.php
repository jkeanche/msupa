<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('vendor.settings.index');
    }

    public function create()
    {
        return view('vendor.settings.create');
    }

    public function store(Request $request)
    {
        // Store logic
        return redirect()->route('vendor.settings.index')->with('success', 'Setting created successfully');
    }

    public function show($id)
    {
        return view('vendor.settings.show', compact('id'));
    }

    public function edit($id)
    {
        return view('vendor.settings.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update logic
        return redirect()->route('vendor.settings.index')->with('success', 'Setting updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic
        return redirect()->route('vendor.settings.index')->with('success', 'Setting deleted successfully');
    }
}
