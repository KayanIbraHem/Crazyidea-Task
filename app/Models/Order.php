<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['order_number', 'user_id', 'status', 'payment_status', 'discount', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'Guest']);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id', 'id')->withPivot(['price', 'quantity']);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class, 'order_id');
    }
}
