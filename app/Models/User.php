<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Comment out or remove the Sanctum import if you're not using it
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    // Remove HasApiTokens if you're not using Sanctum
    use HasFactory, Notifiable;
    
    // If you want to use Sanctum after installing it, uncomment the line below
    // use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // admin, supermarket_owner, customer
        'phone',
        'address',
        'profile_picture',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSupermarketOwner()
    {
        return $this->role === 'supermarket_owner';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function supermarket()
    {
        return $this->hasOne(Supermarket::class, 'owner_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}

// app/Models/Store.php
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

// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            $category->slug = $category->slug ?? Str::slug($category->name);
        });
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'slug',
        'description',
        'short_description',
        'regular_price',
        'sale_price',
        'stock_quantity',
        'sku',
        'featured',
        'status',
    ];

    protected $casts = [
        'regular_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'featured' => 'boolean',
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
        return $this->sale_price ?? $this->regular_price;
    }

    public function isInStock()
    {
        return $this->stock_quantity > 0;
    }
}

// Other models would follow a similar pattern
// app/Models/ProductImage.php, app/Models/ProductAttribute.php, etc.