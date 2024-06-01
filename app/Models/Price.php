<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['number', 'size', 'created_by', 'updated_by'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_price', 'price_id', 'product_id');
    }
}
