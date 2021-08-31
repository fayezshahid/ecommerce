<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Color;
use App\Models\Color_Product;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $carts = Cart::where('user_id', '=', $user_id)->get();
        return view('cart',[
            'carts' => $carts,
        ]);
    }

    public function store(Request $request, Product $product)
    {
        $this->validate($request, [
            'size' => 'required',
            'quantity' => 'required|integer',
        ]);

        $total = $request->quantity * $product->price;
        $color_id = Color::where('color', '=', $request->color)->value('id');
        $img = Color_Product::where('product_id', '=', $product->id)->where('color_id', '=', $color_id)->value('image');
        Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'img' => $img,
            'name' => $product->name,
            'color' => $request->color,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'total' => $total,
        ]);


        return redirect()->route('products')->with('status','Product successfully added to the cart.');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart');
    }
}
