<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'subscription_id',
        'amount',
        'fee',
        'net_amount',
        'status', // pending, completed, failed
        'payment_method',
        'payment_id',
        'checkout_request_id',
        'merchant_request_id',
        'reference',
        'type', // order, subscription, feature
        'notes',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'metadata' => 'array',
    ];

    /**
     * Get the user associated with the transaction
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order associated with the transaction
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the subscription associated with the transaction
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Check if transaction is completed
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
