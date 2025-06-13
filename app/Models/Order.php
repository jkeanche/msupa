<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'store_id',
        'order_number',
        'status', // pending, processing, shipped, delivered, cancelled, refunded
        'total_amount',
        'discount_amount',
        'coupon_id',
        'shipping_cost',
        'payment_method',
        'payment_status', // pending, paid, failed
        'shipping_address',
        'billing_address',
        'shipping_method',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'delivered_at' => 'datetime',
    ];

    /**
     * Get the customer who placed the order
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the store for this order
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the items in this order
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the transactions for this order
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Check if order is paid
     */
    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Get order status badge
     */
    public function getStatusBadge()
    {
        $colors = [
            'pending' => 'yellow',
            'processing' => 'blue',
            'shipped' => 'indigo',
            'delivered' => 'green',
            'cancelled' => 'red',
            'refunded' => 'purple',
        ];

        return $colors[$this->status] ?? 'gray';
    }
}
