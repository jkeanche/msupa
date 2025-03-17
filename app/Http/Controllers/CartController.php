<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
    private function getCart()
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id(),
            ]);
        } else {
            $sessionId = Session::get('cart_session_id');
            
            if (!$sessionId) {
                $sessionId = Str::random(40);
                Session::put('cart_session_id', $sessionId);
            }
            
            $cart = Cart::firstOrCreate([
                'session_id' => $sessionId,
            ]);
        }
        
        return $cart;
    }
    
    public function index()
    {
        $cart = $this->getCart();
        $cartItems = CartItem::where('cart_id', $cart->id)
            ->with(['product.store', 'product.images'])
            ->get();
            
        $coupon = null;
        if ($cart->coupon_id) {
            $coupon = Coupon::find($cart->coupon_id);
        }
        
        return view('cart.index', compact('cartItems', 'coupon'));
    }
    
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $product = Product::findOrFail($request->product_id);
        
        if ($product->stock_quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }
        
        $cart = $this->getCart();
        
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();
            
        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $request->product_id;
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }
        
        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        $cartItem = CartItem::findOrFail($id);
        $cart = $this->getCart();
        
        if ($cartItem->cart_id != $cart->id) {
            return abort(403);
        }
        
        $product = Product::findOrFail($cartItem->product_id);
        
        if ($product->stock_quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }
        
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        
        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }
    
    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cart = $this->getCart();
        
        if ($cartItem->cart_id != $cart->id) {
            return abort(403);
        }
        
        $cartItem->delete();
        
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
    
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:coupons,code',
        ]);
        
        $coupon = Coupon::where('code', $request->code)
            ->where('status', true)
            ->where('starts_at', '<=', now())
            ->where('expires_at', '>=', now())
            ->first();
            
        if (!$coupon) {
            return redirect()->back()->with('error', 'Invalid coupon code or expired.');
        }
        
        if ($coupon->usage_limit && $coupon->usage_count >= $coupon->usage_limit) {
            return redirect()->back()->with('error', 'Coupon usage limit reached.');
        }
        
        $cart = $this->getCart();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        
        $total = 0;
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            $total += $product->getCurrentPrice() * $item->quantity;
        }
        
        if ($coupon->min_order_value && $total < $coupon->min_order_value) {
            return redirect()->back()->with('error', "Minimum order value of {$coupon->min_order_value} required for this coupon.");
        }
        
        // Check if coupon applies to specific products
        if ($coupon->applicable_to === 'specific') {
            $validProductIds = $coupon->products()->pluck('product_id')->toArray();
            $hasValidProduct = false;
            
            foreach ($cartItems as $item) {
                if (in_array($item->product_id, $validProductIds)) {
                    $hasValidProduct = true;
                    break;
                }
            }
            
            if (!$hasValidProduct) {
                return redirect()->back()->with('error', 'Coupon is not applicable to any product in your cart.');
            }
        }
        
        $cart->coupon_id = $coupon->id;
        $cart->save();
        
        return redirect()->route('cart.index')->with('success', 'Coupon applied successfully.');
    }
    
    public function removeCoupon()
    {
        $cart = $this->getCart();
        $cart->coupon_id = null;
        $cart->save();
        
        return redirect()->route('cart.index')->with('success', 'Coupon removed.');
    }
}
