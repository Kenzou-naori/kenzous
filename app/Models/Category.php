<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use Sluggable, SoftDeletes;


    public $fillable = [
        'category_name',
        'slug_category',

    ];
    public function sluggable()
    {
        return [
            'slug_category' => [
                'source' => 'category_name',
                'alpha_dash',
                'unique:categories'
            ]
        ];
    }
    public function getRouteKeyName()
{
    return 'slug_category';
}

    public $timestamps = true;

}
