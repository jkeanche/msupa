<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderItems = OrderItem::with('order', 'product')->get();
        return response()->json(['data' => $orderItems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method isn't typically used in API controllers
        return response()->json(['message' => 'Method not implemented for API']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $orderItem = OrderItem::create($request->all());
        return response()->json(['message' => 'Order item created successfully', 'data' => $orderItem], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        $orderItem->load('order', 'product');
        return response()->json(['data' => $orderItem]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItem $orderItem)
    {
        // This method isn't typically used in API controllers
        return response()->json(['message' => 'Method not implemented for API']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'sometimes|exists:orders,id',
            'product_id' => 'sometimes|exists:products,id',
            'quantity' => 'sometimes|integer|min:1',
            'unit_price' => 'sometimes|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $orderItem->update($request->all());
        return response()->json(['message' => 'Order item updated successfully', 'data' => $orderItem]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return response()->json(['message' => 'Order item deleted successfully'], 200);
    }
}
