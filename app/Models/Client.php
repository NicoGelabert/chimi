<?php

namespace App\Models;

use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Client extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = ['title', 'image', 'image_mime', 'image_size', 'description', 'published', 'created_by', 'updated_by'];

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

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function serviceItems()
    {
        return $this->belongsToMany(ServiceItem::class, 'client_service_item', 'client_id', 'service_item_id');
    }

    public function services()
    {
        return $this->hasManyThrough(Service::class, ServiceItem::class);
    }

}
