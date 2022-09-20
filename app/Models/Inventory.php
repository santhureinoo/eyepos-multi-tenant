<?php

namespace App\Models;

use App\Models\Inventory\Brand;
use App\Models\Inventory\Category;
use App\Models\Inventory\Price;
use App\Models\Inventory\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'purchase_at' => 'date',
        'soldout_at'  => 'date'
    ];

    /**
     * Scope a query with only in stock items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInStock($query)
    {
        return $query->where('quantity', '>=', 1);
    }

    /**
     * Scope a query with only out of in stock items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOutOfStock($query)
    {
        return $query->where('quantity', '===', 0);
    }

    /**
     * BelongsTo Supplier.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'supplier_id', 'id');
    }

    /**
     * BelongsTo Supplier.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    /**
     * BelongsTo Customer.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    /**
     * HasMany Orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'inventory_id', 'id');
    }
}
