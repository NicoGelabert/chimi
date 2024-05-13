<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->where('published', '=', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(8);
        return view('product.index', [
            'products' => $products,
        ]);
    }

    public function view(Categories $categories, Product $product)
    {
        $categories = Categories::all();
        $products = Product::all();
        return view('product.view', ['categories' => $categories, 'product' => $product, 'products' => $products]);
    }
    public function categories()
    {
        return Categories::all();
    }
}
