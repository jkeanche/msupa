<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;
        $coupons = Coupon::where('store_id', $store->id)
            ->latest()
            ->paginate(10);
            
        return view('vendor.coupons.index', compact('coupons'));
    }
    
    public function create()
    {
        $store = Auth::user()->store;
        $products = Product::where('store_id', $store->id)
            ->where('status', 'active')
            ->get();
            
        return view('vendor.coupons.create', compact('products'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'max_discount_value' => 'nullable|numeric|min:0',
            'starts_at' => 'required|date',
            'expires_at' => 'required|date|after:starts_at',
            'usage_limit' => 'nullable|integer|min:1',
            'applicable_to' => 'required|in:all,specific',
            'products' => 'required_if:applicable_to,specific|array',
            'products.*' => 'exists:products,id',
        ]);
        
        $store = Auth::user()->store;
        
        $coupon = new Coupon();
        $coupon->store_id = $store->id;
        $coupon->code = strtoupper($request->code);
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->min_order_value = $request->min_order_value;
        $coupon->max_discount_value = $request->max_discount_value;
        $coupon->starts_at = $request->starts_at;
        $coupon->expires_at = $request->expires_at;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->applicable_to = $request->applicable_to;
        $coupon->status = $request->has('status');
        $coupon->save();
        
        if ($request->applicable_to === 'specific' && $request->has('products')) {
            $coupon->products()->attach($request->products);
        }
        
        return redirect()->route('vendor.coupons.index')->with('success', 'Coupon created successfully.');
    }
    
    // Other methods (edit, update, destroy) would follow similar patterns
}