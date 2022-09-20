<?php

namespace App\Models\Inventory;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_suppliers';

    /**
     * HasMany Inventory
     */
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'id', 'supplier_id');
    }
}
