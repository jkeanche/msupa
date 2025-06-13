<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of all active stores.
     */
    public function index()
    {
        $stores = Store::where('is_active', true)
            ->whereHas('subscription', function ($query) {
                $query->where('status', 'active');
            })
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            // Add other fields as needed
        ]);

        Store::create($validated);

        return redirect()->route('stores.index')
            ->with('success', 'Store created successfully.');
    }

    /**
     * Display the specified store.
     */
    public function show(Store $store)
    {
        if (!$store->is_active) {
            abort(404);
        }

        $products = $store->products()
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(16);

        $categories = $store->categories()
            ->where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->get();

        return view('stores.show', compact('store', 'products', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        return view('stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            // Add other fields as needed
        ]);

        $store->update($validated);

        return redirect()->route('stores.index')
            ->with('success', 'Store updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('stores.index')
            ->with('success', 'Store deleted successfully.');
    }

    /**
     * Display a list of featured stores
     *
     * @return \Illuminate\Http\Response
     */
    public function featured()
    {
        try {
            $featuredStores = Store::where('is_featured', 1)->limit(6)->get();
            return view('stores.featured', compact('featuredStores'));
        } catch (QueryException $e) {
            // If the column doesn't exist, show a message or return empty collection
            if ($e->getCode() == '42S22') {
                return view('stores.featured', ['featuredStores' => collect([])]);
            }
            throw $e;
        }
    }
}
