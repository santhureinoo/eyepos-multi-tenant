<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Http\Requests\NovaRequest;

class ServiceOffers extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
