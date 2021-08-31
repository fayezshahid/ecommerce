<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Product $product)
    {
        $cart = Cart::where('user_id', '=', auth()->user()->id)->where('product_id', '=', $product->id)->first();
        // $img = Cart::where('user_id', '=', auth()->user()->id)->where('product_id', '=', $product->id)->value('img');
        return view('orderproduct',[
            'cart' => $cart,
            'product' => $product,
            // 'img' => $img,
        ]);
    }

    public function store(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|max:255',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required|digits:11',
            'payment' => 'required',
            'creditCardNumber' => 'required_if:payment,cc|digits:13',
            'easyPaisaNumber' => 'required_if:payment,epaisa|digits:11',
        ]);

        Order::create([
            'product_id' => $product->id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'payment' => $request->payment,
            'creditCardNumber' => $request->creditCardNumber,
            'easyPaisaNumber' => $request->easyPaisaNumber,
        ]);

        return redirect()->route('home')->with('status', 'Thankyou for shopping. Your order has been placed successfully');
    }
}
