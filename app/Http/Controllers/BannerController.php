<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'is_active' => 'boolean',
            'position' => 'required|string|in:home_top,home_middle,category_page,product_page',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        
        Banner::create($validated);
        
        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'is_active' => 'boolean',
            'position' => 'required|string|in:home_top,home_middle,category_page,product_page',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image) {
                }
                $path = $request->file('image')->store('banners', 'public');
                $validated['image'] = $path;
            }

            $validated['is_active'] = $request->has('is_active');
            
            $banner->update($validated);
            
            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner updated successfully');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Banner $banner)
        {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            
            $banner->delete();
            
            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner deleted successfully');
        }
    }
