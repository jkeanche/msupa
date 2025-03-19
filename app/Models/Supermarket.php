<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supermarket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'banner',
        'owner_id',
        'subscription_id',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'email',
        'website',
        'is_active',
        'delivery_fee',
        'minimum_order_amount',
        'tax_rate',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'delivery_fee' => 'decimal:2',
        'minimum_order_amount' => 'decimal:2',
        'tax_rate' => 'decimal:2',
    ];

    /**
     * Get the owner (user) of this supermarket
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the subscription for this supermarket
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Get the products for this supermarket
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the categories for this supermarket
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Get the orders for this supermarket
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    /**
     * Scope a query to only include active supermarkets
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
