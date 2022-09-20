<?php

namespace App\Models\Customer;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_documents';

    /**
     * BelongsTo Customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

    /**
     * BelongsTo OcularHistory.
     */
    public function examinations()
    {
        return $this->belongsTo(Examination::class, 'examination_id', 'id');
    }
}
