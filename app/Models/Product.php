<?php

namespace App\Models;

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
}
