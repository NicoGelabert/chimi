<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function view(Category $category, Product $product)
    {
        $categories = Category::all();
        $products = Product::all();
        return view('product.view', ['categories' => $categories, 'products' => $products, 'category' => $category, 'product' => $product]);
    }
    public function categories()
    {
        return Category::all();
    }

    public function categoriasJson()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
}
