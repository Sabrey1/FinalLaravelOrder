<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'customer_id',
        'total_amount',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price')->withTimestamps();
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
