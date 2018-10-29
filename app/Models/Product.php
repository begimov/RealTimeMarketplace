<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'price'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('price', '>', 0);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
