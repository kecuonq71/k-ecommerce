<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use App\Models\Product;
class CartController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content(); 
        return view('user.cart.index', compact('items'));
    }

    public function add_to_cart(Request $request) {
        Cart::instance('cart')->add(
            $request->id,
            $request->name, 
            $request->quantity, 
            $request->price)->associate(Product::class);
        return redirect()->back()->with('message', 'Product has been added to cart!');
    }
}
