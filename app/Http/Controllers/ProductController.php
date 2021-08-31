<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color_Product;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $products = Product::paginate(9);
        return view('products',[
            'products' => $products,
            'categories' => $categories,
        ]);
    }


    public function show(Product $product)
    {
        $images = Color_Product::where('product_id', '=', $product->id)->get();
        return view('showproduct', [
            'product' => $product,
            'images' => $images,
        ]);
    }


    public function sort($category)
    {
        $categories = Category::get();
        $products = Product::where('category', '=', $category)->paginate(9);
        return view('category', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }


}
