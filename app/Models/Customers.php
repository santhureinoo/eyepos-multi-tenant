<?php

namespace App\Models;

use App\Models\Customer\Document;
use App\Models\Customer\Examination;
use App\Models\Customer\Vision;
use App\Models\Customer\Visit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'dob' => 'date'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function vision()
    {
        return $this->hasMany(Vision::class, 'customer_id', 'id');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class, 'customer_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'customer_id', 'id');
    }

    public function examinations()
    {
        return $this->hasMany(Examination::class, 'customer_id', 'id');
    }
}
