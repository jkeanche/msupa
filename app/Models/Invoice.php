<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'store_id',
        'subscription_id',
        'invoice_number',
        'amount',
        'tax_amount',
        'total_amount',
        'plan_name',
        'status',
        'payment_method',
        'transaction_id',
        'billing_address',
        'due_date',
        'paid_date',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'due_date' => 'date',
        'paid_date' => 'date',
    ];

    /**
     * Get the store that owns the invoice
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the subscription associated with the invoice
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Generate a unique invoice number
     */
    public static function generateInvoiceNumber()
    {
        $prefix = 'INV-';
        $year = date('Y');
        $month = date('m');
        
        $latestInvoice = self::where('invoice_number', 'like', "{$prefix}{$year}{$month}%")
            ->orderBy('id', 'desc')
            ->first();
        
        if ($latestInvoice) {
            $lastNumber = (int) substr($latestInvoice->invoice_number, -5);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . $year . $month . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Get the formatted amount with currency symbol
     */
    public function getFormattedAmountAttribute()
    {
        return '$' . number_format($this->amount, 2);
    }

    /**
     * Get the formatted tax amount with currency symbol
     */
    public function getFormattedTaxAmountAttribute()
    {
        return '$' . number_format($this->tax_amount, 2);
    }

    /**
     * Get the formatted total amount with currency symbol
     */
    public function getFormattedTotalAmountAttribute()
    {
        return '$' . number_format($this->total_amount, 2);
    }

    /**
     * Check if the invoice is paid
     */
    public function isPaid()
    {
        return $this->status === 'paid';
    }

    /**
     * Check if the invoice is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the invoice is overdue
     */
    public function isOverdue()
    {
        return $this->status === 'pending' && $this->due_date && $this->due_date < now();
    }
}
