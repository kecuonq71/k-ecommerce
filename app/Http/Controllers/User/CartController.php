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

    public function increase_cart_quantity($id) {
        $product = Cart::instance('cart')->get($id);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($id, $qty);
        
        return redirect()->back();
    }

    public function decrease_cart_quantity($id) {
        $product = Cart::instance('cart')->get($id);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($id, $qty);
        
        return redirect()->back();
    }

    public function remove_item($id) {
        Cart::instance('cart')->remove($id);

        return redirect()->back();
    }

    public function clear_cart(){
        Cart::instance('cart')->destroy();

        return redirect()->back();
    }
}