<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'stock_quantity',
        'sku',
        'images',
        'is_featured',
        'featured_until',
        'is_active',
        'weight',
        'dimensions',
        'brand',
        'tags',
        'supermarket_id',
        'weight_unit',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'featured_until' => 'datetime',
        'images' => 'array',
        'dimensions' => 'array',
        'tags' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            $product->slug = $product->slug ?? Str::slug($product->name);
        });
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_products');
    }

    public function getCurrentPrice()
    {
        return $this->isOnSale() ? $this->sale_price : $this->price;
    }

    public function isInStock()
    {
        return $this->stock_quantity > 0;
    }

    public function isOnSale()
    {
        return $this->sale_price && $this->sale_price < $this->price;
    }

    public function discountPercentage()
    {
        if ($this->isOnSale()) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    public function isLowStock()
    {
        return $this->stock_quantity <= 5;
    }

    public function supermarket()
    {
        return $this->belongsTo(Supermarket::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
                    ->where(function($query) {
                        $query->whereNull('featured_until')
                              ->orWhere('featured_until', '>', now());
                    });
    }

    public function getDiscountPercentage()
    {
        if (!$this->isOnSale()) return 0;
        
        return round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    public function inStock()
    {
        return $this->stock_quantity > 0;
    }

    public function getLowStockThreshold()
    {
        return max(5, $this->stock_quantity * 0.2);
    }

    public function isLowStock()
    {
        return $this->stock_quantity > 0 && $this->stock_quantity <= $this->getLowStockThreshold();
    }
}