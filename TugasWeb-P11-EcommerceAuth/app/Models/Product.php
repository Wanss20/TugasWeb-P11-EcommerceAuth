<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'stock', 'weight', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // --- scope ---

    // Product::active()->get()
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Product::inStock()->get()
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Product::priceBetween(50000, 200000)->get()
    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    // buat nampilin harga format rupiah
    public function getHargaRupiahAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
