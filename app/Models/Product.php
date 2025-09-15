<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Which table (optional, Laravel auto detects)
    protected $table = 'products';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'category_id',
        'sku',
        'barcode',
        'image',
        'product_options',
        'description',
        'price',
        'discount_price',
        'quantity',
        'status',
    ];

    // Cast JSON columns automatically
    protected $casts = [
        'product_options' => 'array',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function images()
{
    return $this->hasMany(ProductImage::class);
}
}
