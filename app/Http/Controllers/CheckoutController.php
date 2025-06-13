<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please login to checkout.');
        }
        
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        
        if (!$cart || CartItem::where('cart_id', $cart->id)->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        $cartItems = CartItem::where('cart_id', $cart->id)
            ->with(['product.store', 'product.images'])
            ->get();
            
        $total = 0;
        foreach ($cartItems as $item) {
            $product = $item->product;
            $item->price = $product->getCurrentPrice();
            $item->subtotal = $item->price * $item->quantity;
            $total += $item->subtotal;
        }
        
        $discount = 0;
        if ($cart->coupon_id) {
            $coupon = Coupon::find($cart->coupon_id);
            
            if ($coupon) {
                if ($coupon->type === 'percentage') {
                    $discount = $total * ($coupon->value / 100);
                    if ($coupon->max_discount_value && $discount > $coupon->max_discount_value) {
                        $discount = $coupon->max_discount_value;
                    }
                } else {
                    $discount = $coupon->value;
                }
            }
        }
        
        $finalTotal = $total - $discount;
        
        return view('checkout.index', compact('cartItems', 'total', 'discount', 'finalTotal', 'user'));
    }
    
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'payment_method' => 'required|in:wallet,credit_card,paypal',
            'notes' => 'nullable|string',
        ]);
        
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        
        if (!$cart || CartItem::where('cart_id', $cart->id)->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        $cartItems = CartItem::where('cart_id', $cart->id)
            ->with(['product.store'])
            ->get();
            
        $total = 0;
        $discount = 0;
        $coupon = null;
        
        if ($cart->coupon_id) {
            $coupon = Coupon::find($cart->coupon_id);
        }
        
        foreach ($cartItems as $item) {
            $product = $item->product;
            
            // Check if product has enough stock
            if ($product->stock_quantity < $item->quantity) {
                return redirect()->route('checkout.index')->with('error', "Not enough stock for {$product->name}.");
            }
            
            $price = $product->getCurrentPrice();
            $total += $price * $item->quantity;
        }
        
        if ($coupon) {
            if ($coupon->type === 'percentage') {
                $discount = $total * ($coupon->value / 100);
                if ($coupon->max_discount_value && $discount > $coupon->max_discount_value) {
                    $discount = $coupon->max_discount_value;
                }
            } else {
                $discount = $coupon->value;
            }
        }
        
        $finalTotal = $total - $discount;
        
        // Process payment based on method
        $paymentSuccess = false;
        
        DB::beginTransaction();
        
        try {
            if ($request->payment_method === 'wallet') {
                // Check if user has enough balance
                if ($user->balanceFloat < $finalTotal) {
                    return redirect()->route('checkout.index')->with('error', 'Insufficient wallet balance.');
                }
                
                // Deduct from wallet
                $user->withdraw($finalTotal);
                $paymentSuccess = true;
            } else {
                // This would typically involve a payment gateway
                // For demonstration, we'll just assume it's successful
                $paymentSuccess = true;
            }
            
            if ($paymentSuccess) {
                // Create order
                $order = new Order();
                $order->user_id = $user->id;
                $order->order_number = 'ORD-' . strtoupper(Str::random(10));
                $order->status = 'pending';
                $order->total_amount = $finalTotal;
                $order->discount_amount = $discount;
                $order->coupon_id = $cart->coupon_id;
                $order->payment_method = $request->payment_method;
                $order->payment_status = 'paid';
                
                // Combine address parts
                $shippingAddress = json_encode([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'postal_code' => $request->postal_code,
                    'country' => $request->country,
                ]);
                
                $order->shipping_address = $shippingAddress;
                $order->billing_address = $shippingAddress; // Same as shipping for this demo
                $order->notes = $request->notes;
                $order->save();
                
                // Create order items
                foreach ($cartItems as $item) {
                    $product = $item->product;
                    $price = $product->getCurrentPrice();
                    
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $product->id;
                    $orderItem->store_id = $product->store_id;
                    $orderItem->quantity = $item->quantity;
                    $orderItem->price = $price;
                    $orderItem->total = $price * $item->quantity;
                    $orderItem->save();
                    
                    // Update product stock
                    $product->stock_quantity -= $item->quantity;
                    $product->save();
                    
                    // Calculate commission for store
                    $store = $product->store;
                    $commissionRate = $store->commission_rate / 100;
                    $commission = $orderItem->total * $commissionRate;
                    $storeAmount = $orderItem->total - $commission;
                    
                    // Add to store's wallet
                    $store->deposit($storeAmount);
                }
                
                // Create initial order status
                $status = new OrderStatus();
                $status->order_id = $order->id;
                $status->status = 'pending';
                $status->comments = 'Order placed successfully.';
                $status->save();
                
                // Update coupon usage if used
                if ($coupon) {
                    $coupon->usage_count++;
                    $coupon->save();
                }
                
                // Clear cart
                CartItem::where('cart_id', $cart->id)->delete();
                $cart->coupon_id = null;
                $cart->save();
                
                DB::commit();
                
                return redirect()->route('user.orders.show', $order->id)->with('success', 'Order placed successfully.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('checkout.index')->with('error', 'An error occurred while processing your order: ' . $e->getMessage());
        }
        
        return redirect()->route('checkout.index')->with('error', 'Payment failed. Please try again.');
    }
}
