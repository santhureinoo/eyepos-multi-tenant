<?php

namespace App\Models\Customer;

use App\Events\CustomerExaminationProcessed;
use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Examination extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_examinations';

    protected $with = [
        'customer',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($examination) {});

        static::created(function ($examination) {
            CustomerExaminationProcessed::dispatch($examination);
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
     * BelongsTo Visit.
     */
    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id', 'id');
    }
}
