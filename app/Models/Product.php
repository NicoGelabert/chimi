<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'price', 'image', 'published', 'categories_id', 'image_mime', 'image_size', 'created_by', 'updated_by'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function category()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }

    public function alergens()
    {
        return $this->belongsToMany(Alergen::class, 'products_alergens', 'product_id', 'alergen_id');
    }

    public function prices()
    {
        return $this->belongsToMany(Price::class, 'product_price', 'product_id', 'price_id');
    }

}

