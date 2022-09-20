<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    use HasFactory;

    /**
     * BelongsTo Customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
}
