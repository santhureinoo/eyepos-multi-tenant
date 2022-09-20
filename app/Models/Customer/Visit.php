<?php

namespace App\Models\Customer;

use App\Events\CustomerVisitProcessed;
use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['examinations'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_visits';

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($visit) {
            CustomerVisitProcessed::dispatch($visit);
        });
    }

    /**
     * BelongsTo Customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

    public function examinations()
    {
        return $this->hasMany(Examination::class, 'visit_id', 'id');
    }
}
