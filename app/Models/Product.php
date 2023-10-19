<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'category_id', 'description'];

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id')->withPivot(['price', 'size_id']);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->select('id', 'name');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }
}
