<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'store_id',
        'subscription_plan_id',
        'start_date',
        'end_date',
        'status', // active, canceled, expired, pending
        'payment_status', // paid, unpaid, refunded
        'amount_paid',
        'transaction_id',
        'payment_method',
        'auto_renew',
        'canceled_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'canceled_at' => 'datetime',
        'amount_paid' => 'decimal:2',
        'auto_renew' => 'boolean',
    ];

    /**
     * Get the store that owns the subscription
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the plan for this subscription
     */
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    /**
     * Check if subscription is active
     */
    public function isActive()
    {
        return $this->status === 'active' && $this->end_date > now();
    }

    /**
     * Check if subscription is due for renewal soon (within 7 days)
     */
    public function dueForRenewalSoon()
    {
        return $this->isActive() && $this->end_date->diffInDays(now()) <= 7;
    }

    /**
     * Days left in the subscription
     */
    public function daysLeft()
    {
        if (!$this->isActive()) return 0;
        return now()->diffInDays($this->end_date, false);
    }

    /**
     * Scope a query to only include active subscriptions
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                     ->where('end_date', '>', now());
    }

    /**
     * Scope a query to only include expired subscriptions
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'active')
                     ->where('end_date', '<', now());
    }

    /**
     * Scope a query to include subscriptions due for renewal soon
     */
    public function scopeDueForRenewal($query, $days = 7)
    {
        $date = now()->addDays($days);
        return $query->where('status', 'active')
                     ->where('end_date', '<=', $date)
                     ->where('end_date', '>', now());
    }
}
