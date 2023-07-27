<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Sluggable, SoftDeletes;


    public $fillable = [
        'product_id',
        'name',
        'slug',
        'category_id',
        'price',
        'quantity',
        'image',
        'description',
    ];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'alpha_dash',
                'unique:products'
            ]
        ];
    }
    public function getRouteKeyName()
{
    return 'slug';
}

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class);

    }
}
