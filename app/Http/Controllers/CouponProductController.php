<?php

namespace App\Http\Controllers;

use App\Models\CouponProduct;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $couponProducts = CouponProduct::with(['coupon', 'product'])->paginate(10);
        return response()->json($couponProducts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coupons = Coupon::all();
        $products = Product::all();
        return response()->json([
            'coupons' => $coupons,
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_id' => 'required|exists:coupons,id',
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $couponProduct = CouponProduct::create($request->all());
        return response()->json($couponProduct, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CouponProduct $couponProduct)
    {
        $couponProduct->load(['coupon', 'product']);
        return response()->json($couponProduct);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CouponProduct $couponProduct)
    {
        $couponProduct->load(['coupon', 'product']);
        $coupons = Coupon::all();
        $products = Product::all();
        
        return response()->json([
            'couponProduct' => $couponProduct,
            'coupons' => $coupons,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CouponProduct $couponProduct)
    {
        $validator = Validator::make($request->all(), [
            'coupon_id' => 'required|exists:coupons,id',
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $couponProduct->update($request->all());
        return response()->json($couponProduct);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CouponProduct $couponProduct)
    {
        $couponProduct->delete();
        return response()->json(null, 204);
    }
}
