<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Store;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $store = $user->store;
        
        // Get payment, shipping, and other settings
        $paymentSettings = $store ? json_decode($store->payment_settings) : null;
        $shippingSettings = $store ? json_decode($store->shipping_settings) : null;
        $taxSettings = $store ? json_decode($store->tax_settings) : null;
        $notificationSettings = $store ? json_decode($store->notification_settings) : null;
        $seoSettings = $store ? json_decode($store->seo_settings) : null;
        $policySettings = $store ? json_decode($store->policy_settings) : null;
        $apiSettings = $store ? json_decode($store->api_settings) : null;
        
        return view('vendor.settings.index', compact(
            'store', 
            'paymentSettings', 
            'shippingSettings', 
            'taxSettings', 
            'notificationSettings', 
            'seoSettings', 
            'policySettings', 
            'apiSettings'
        ));
    }

    public function create()
    {
        return view('vendor.settings.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $store = $user->store;
        
        if (!$store) {
            return redirect()->back()->with('error', 'Store not found');
        }
        
        // Validate the request
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_email' => 'required|email|max:255',
            'store_phone' => 'nullable|string|max:20',
            'store_status' => 'required|in:active,maintenance,vacation,closed',
            'store_description' => 'nullable|string',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Update general store settings
        $store->name = $request->store_name;
        $store->email = $request->store_email;
        $store->phone = $request->store_phone;
        $store->status = $request->store_status;
        $store->description = $request->store_description;
        
        // Handle logo upload
        if ($request->hasFile('store_logo')) {
            // Delete old logo if exists
            if ($store->logo && Storage::exists($store->logo)) {
                Storage::delete($store->logo);
            }
            
            $logoPath = $request->file('store_logo')->store('store/logos', 'public');
            $store->logo = 'storage/' . $logoPath;
        }
        
        // Handle banner upload
        if ($request->hasFile('store_banner')) {
            // Delete old banner if exists
            if ($store->banner && Storage::exists($store->banner)) {
                Storage::delete($store->banner);
            }
            
            $bannerPath = $request->file('store_banner')->store('store/banners', 'public');
            $store->banner = 'storage/' . $bannerPath;
        }
        
        // Process payment settings
        $paymentSettings = [
            'payment_methods' => $request->payment_methods ?? [],
            'currency' => $request->currency ?? 'USD',
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'routing_number' => $request->routing_number,
            'paypal_email' => $request->paypal_email,
            'mpesa_phone' => $request->mpesa_phone,
            'stripe_account' => $request->stripe_account,
        ];
        $store->payment_settings = json_encode($paymentSettings);
        
        // Process shipping settings
        $shippingSettings = [
            'enable_shipping' => $request->has('enable_shipping'),
            'shipping_methods' => $request->shipping_methods ?? [],
            'standard_shipping_fee' => $request->standard_shipping_fee,
            'express_shipping_fee' => $request->express_shipping_fee,
            'free_shipping_threshold' => $request->free_shipping_threshold,
            'shipping_countries' => $request->shipping_countries ?? [],
            'shipping_zones' => $request->shipping_zones ?? [],
        ];
        $store->shipping_settings = json_encode($shippingSettings);
        
        // Process tax settings
        $taxSettings = [
            'enable_tax' => $request->has('enable_tax'),
            'tax_rate' => $request->tax_rate,
            'tax_included' => $request->has('tax_included'),
            'tax_countries' => $request->tax_countries ?? [],
        ];
        $store->tax_settings = json_encode($taxSettings);
        
        // Process notification settings
        $notificationSettings = [
            'order_notifications' => $request->has('order_notifications'),
            'customer_notifications' => $request->has('customer_notifications'),
            'product_notifications' => $request->has('product_notifications'),
            'email_notifications' => $request->has('email_notifications'),
            'sms_notifications' => $request->has('sms_notifications'),
            'push_notifications' => $request->has('push_notifications'),
        ];
        $store->notification_settings = json_encode($notificationSettings);
        
        // Process SEO settings
        $seoSettings = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'google_analytics_id' => $request->google_analytics_id,
            'facebook_pixel_id' => $request->facebook_pixel_id,
        ];
        $store->seo_settings = json_encode($seoSettings);
        
        // Process policy settings
        $policySettings = [
            'return_policy' => $request->return_policy,
            'shipping_policy' => $request->shipping_policy,
            'privacy_policy' => $request->privacy_policy,
            'terms_of_service' => $request->terms_of_service,
        ];
        $store->policy_settings = json_encode($policySettings);
        
        // Process API settings
        $apiSettings = [
            'enable_api' => $request->has('enable_api'),
            'api_key' => $request->api_key,
            'api_secret' => $request->api_secret,
        ];
        $store->api_settings = json_encode($apiSettings);
        
        // Save all settings
        $store->save();
        
        return redirect()->route('vendor.settings.index')->with('success', 'Store settings updated successfully');
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
