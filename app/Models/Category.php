<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'category_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->select('id', 'name', 'category_id')->withDefault(['name' => 'MainCategory']);
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'category_id', 'id')->select('id', 'name', 'category_id')->with('child');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id')->select('id', 'name', 'category_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
