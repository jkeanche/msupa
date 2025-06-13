<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubscriptionPlan extends Model
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
        'monthly_price',
        'annual_price',
        'product_limit',
        'storage_limit',
        'category_limit',
        'commission_rate',
        'featured_products',
        'support_level',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'monthly_price' => 'decimal:2',
        'annual_price' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($plan) {
            $plan->slug = $plan->slug ?? Str::slug($plan->name);
        });
    }

    /**
     * Get the subscriptions for this plan
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'subscription_plan_id');
    }

    /**
     * Get the monthly price formatted with currency symbol
     */
    public function getFormattedMonthlyPriceAttribute()
    {
        return '$' . number_format($this->monthly_price, 2);
    }

    /**
     * Get the annual price formatted with currency symbol
     */
    public function getFormattedAnnualPriceAttribute()
    {
        return '$' . number_format($this->annual_price, 2);
    }

    /**
     * Get the monthly equivalent of the annual price
     */
    public function getMonthlyEquivalentAttribute()
    {
        return $this->annual_price / 12;
    }

    /**
     * Get the formatted monthly equivalent of the annual price
     */
    public function getFormattedMonthlyEquivalentAttribute()
    {
        return '$' . number_format($this->monthly_equivalent, 2);
    }

    /**
     * Get the savings percentage when paying annually
     */
    public function getAnnualSavingsPercentageAttribute()
    {
        $monthlyTotal = $this->monthly_price * 12;
        $savings = $monthlyTotal - $this->annual_price;
        
        return ($savings / $monthlyTotal) * 100;
    }
}
