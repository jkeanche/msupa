<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\InventoryHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::where('store_id', Auth::user()->store->id ?? 0)
                        ->with(['category', 'images']);
        
        // Filter by stock status
        if ($request->has('stock_status')) {
            switch ($request->stock_status) {
                case 'in_stock':
                    $query->where('stock_quantity', '>', 5);
                    break;
                case 'low_stock':
                    $query->whereBetween('stock_quantity', [1, 5]);
                    break;
                case 'out_of_stock':
                    $query->where('stock_quantity', '<=', 0);
                    break;
            }
        }
        
        // Search by name or SKU
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }
        
        $products = $query->paginate(10);
        
        // Get inventory statistics
        $totalProducts = Product::where('store_id', Auth::user()->store->id ?? 0)->count();
        $lowStockCount = Product::where('store_id', Auth::user()->store->id ?? 0)
                                ->whereBetween('stock_quantity', [1, 5])
                                ->count();
        $outOfStockCount = Product::where('store_id', Auth::user()->store->id ?? 0)
                                  ->where('stock_quantity', '<=', 0)
                                  ->count();
        
        return view('vendor.inventory.index', compact(
            'products', 
            'totalProducts', 
            'lowStockCount', 
            'outOfStockCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation and storage logic here
        
        return redirect()->route('vendor.inventory.index')
            ->with('success', 'Inventory updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('vendor.inventory.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['category', 'images'])
                          ->where('store_id', Auth::user()->store->id ?? 0)
                          ->findOrFail($id);
        
        // Get inventory history if the model exists
        $inventoryHistory = [];
        if (class_exists('App\Models\InventoryHistory')) {
            $inventoryHistory = InventoryHistory::where('product_id', $product->id)
                                               ->orderBy('created_at', 'desc')
                                               ->take(5)
                                               ->get();
        }
        
        return view('vendor.inventory.edit', compact('product', 'inventoryHistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
            'update_method' => 'required|in:set,add,subtract',
            'reason' => 'required|string',
            'other_reason' => 'required_if:reason,other|nullable|string',
        ]);
        
        $product = Product::where('store_id', Auth::user()->store->id ?? 0)
                          ->findOrFail($id);
        
        $oldQuantity = $product->stock_quantity;
        $newQuantity = $oldQuantity;
        
        // Calculate new quantity based on update method
        switch ($request->update_method) {
            case 'set':
                $newQuantity = $request->quantity;
                break;
            case 'add':
                $newQuantity = $oldQuantity + $request->quantity;
                break;
            case 'subtract':
                $newQuantity = max(0, $oldQuantity - $request->quantity);
                break;
        }
        
        // Update product quantity
        $product->stock_quantity = $newQuantity;
        $product->save();
        
        // Record inventory history if the model exists
        if (class_exists('App\Models\InventoryHistory')) {
            $reason = $request->reason === 'other' ? $request->other_reason : $request->reason;
            
            InventoryHistory::create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'old_quantity' => $oldQuantity,
                'new_quantity' => $newQuantity,
                'adjustment_type' => $request->update_method,
                'reason' => $reason,
                'user_id' => Auth::id(),
            ]);
        }
        
        return redirect()->route('vendor.inventory.index')
                         ->with('success', 'Inventory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete logic here
        
        return redirect()->route('vendor.inventory.index')
            ->with('success', 'Inventory deleted successfully');
    }

    /**
     * Display the inventory history for a product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history($id)
    {
        $product = Product::where('store_id', Auth::user()->store->id ?? 0)
                          ->findOrFail($id);
        
        $inventoryHistory = [];
        if (class_exists('App\Models\InventoryHistory')) {
            $inventoryHistory = InventoryHistory::where('product_id', $product->id)
                                               ->orderBy('created_at', 'desc')
                                               ->paginate(15);
        }
        
        return view('vendor.inventory.history', compact('product', 'inventoryHistory'));
    }
}
