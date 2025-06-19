<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ShopController extends Controller
{
    
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('user.shop.index', compact('products'));
    }

    public function productDetail(string $slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('slug', '<>' , $slug)->where('category_id', $product->category_id)->take(8)->get();
        return view('user.shop.product-detail', compact('product', 'relatedProducts'));
    }
    
}
