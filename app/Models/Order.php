<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'order_number',
        'price_at_purchase',
        'quantity',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Add this to access product details in your email
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
