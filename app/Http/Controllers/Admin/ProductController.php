<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\UploadFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Brand;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use UploadFile;

    public function index(Request $request)
    {
        $products = Product::when($request->name, function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->paginate(10)->withQueryString();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create', [
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'products');
        }

        if ($request->hasFile('images')) {
            $data['gallery'] = json_encode(
                $this->uploadMultipleImages($request->file('images'), 'products/thumbnails')
            );
        }


        Product::create($data);

        return redirect()->route('admin.product.index')->with('message', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
