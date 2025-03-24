<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'store_id',
        'parent_id',
        'name',
        'slug',
        'description',
        'image',
        'is_active',
        'display_order',
        'meta_title',
        'meta_description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            $category->slug = $category->slug ?? Str::slug($category->name);
        });
    }

    /**
     * Get the parent category
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the products in this category
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    /**
     * Get the store that owns the category
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Scope a query to only include active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Scope a query to order categories by display order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }

    /**
     * Get the route key name for the model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope a query to only include parent categories
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }
}
