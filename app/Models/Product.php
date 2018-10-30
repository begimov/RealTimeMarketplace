<?php

namespace App\Models;

use App\User;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('price', '>', 0);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
