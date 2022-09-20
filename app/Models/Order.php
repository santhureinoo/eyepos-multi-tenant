<?php

namespace App\Models;

use App\Models\Inventory\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(static function ($order) {
            if($order->inventory_id !== null) {
                DB::table('inventories')->where('id', $order->inventory_id)->decrement('quantity');
            }
        });
    }

    /**
     * BelongsTo Customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

    /**
     * BelongsTo Customer.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    /**
     * BelongsTo Inventory.
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }

    /**
     * BelongsTo Inventory.
     */
    public function service()
    {
        return $this->belongsTo(ServiceOffers::class, 'service_id', 'id');
    }

    /**
     * BelongsToMany Orders.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Inventory::class, 'inventory_id', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
