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
}
