<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image_url',
        'featured_new',
        'featured_trending',
        'featured_bestseller',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'featured_new' => 'boolean',
            'featured_trending' => 'boolean',
            'featured_bestseller' => 'boolean',
        ];
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
