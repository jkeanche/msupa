<?php

namespace App\Models;

use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Store extends Model implements Wallet
{
    use HasFactory, HasWallet;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'logo',
        'banner',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'email',
        'status',
        'commission_rate',
        'owner_id',
        'social_links',
        'is_active',
        'featured_until',
        'rating',
        'rating_count'
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean',
        'featured_until' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($store) {
            $store->slug = $store->slug ?? Str::slug($store->name);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function activeCategories()
    {
        return $this->categories()->where('is_active', true);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class)->latest();
    }

    public function isFeatured()
    {
        return $this->featured_until && $this->featured_until->isFuture();
    }

    public function statistics()
    {
        return [
            'total_products' => $this->products()->count(),
            'total_orders' => $this->orders()->count(),
            'total_sales' => $this->orders()->where('status', 'delivered')->sum('total'),
            'pending_orders' => $this->orders()->where('status', 'pending')->count(),
        ];
    }
}
