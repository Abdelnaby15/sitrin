<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'features',
        'price',
        'sale_price',
        'main_image',
        'images',
        'size',
        'color',
        'fabric',
        'stock',
        'is_featured',
        'is_new_arrival',
        'is_active',
        'sort_order',
        'views',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the final price (sale price if available, otherwise regular price).
     */
    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    /**
     * Check if product is on sale.
     */
    public function isOnSale()
    {
        return $this->sale_price !== null && $this->sale_price < $this->price;
    }

    /**
     * Get discount percentage.
     */
    public function getDiscountPercentageAttribute()
    {
        if ($this->isOnSale()) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    /**
     * Check if product is in stock.
     */
    public function inStock()
    {
        return $this->stock > 0;
    }

    /**
     * Get available sizes as array.
     */
    public function getSizesAttribute()
    {
        return $this->size ? explode(',', $this->size) : [];
    }

    /**
     * Increment views counter.
     */
    public function incrementViews()
    {
        $this->increment('views');
    }
}
