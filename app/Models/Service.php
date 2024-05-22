<?php

namespace App\Models;

use App\Models\ServiceItem;
use App\Models\Client;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Service extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasSlug;

    protected $fillable = ['title', 'image', 'image_mime', 'image_size', 'description', 'created_by', 'updated_by'];

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

    public function serviceItems()
    {
        return $this->hasMany(ServiceItem::class);
    }

    public function clients()
    {
        return $this->hasManyThrough(Client::class, ServiceItem::class);
    }

    public function portfolios()
    {
        return $this->hasManyThrough(Portfolio::class, ServiceItem::Class, 'service_id', 'id', 'id', 'portfolio_id');
    }

}
