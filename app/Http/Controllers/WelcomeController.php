<?php

namespace App\Http\Controllers;

use App\Models\HomeHeroBanner;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $homeHeroBanners = HomeHeroBanner::all();
        $categories = Categories::all();
        $products = Product::query()
            ->where('published', '=', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(4);
            return view('welcome', [
            'products' => $products, 'categories' => $categories, 'homeHeroBanners' => $homeHeroBanners
        ]);
    }
}
