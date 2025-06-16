<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use Illuminate\Support\Str;
use App\Traits\UploadFile;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use UploadFile;

    public function index(Request $request)
    {
        $brands = Brand::when($request->name, function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->paginate(10)->withQueryString();
        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    
    public function store(BrandRequest $brandRequest)
    {
        $data = $brandRequest->validated();
        $data['slug'] = Str::slug($data['slug']);

        if ($brandRequest->hasFile('image')) {
            $data['image'] = $this->uploadImage($brandRequest->file('image'), 'brands');
        }

        Brand::create($data);

        return redirect()->route('admin.brands.index')->with('message', 'Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        return view('admin.brand.edit', [
            'brand' => $brand,
            'readonly' => true
        ]);
    }

    
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    
    public function update(BrandRequest $request, Brand $brand)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'brand');
        }

        $brand->update($data);

        return redirect()->route(('admin.brands.index'))->with('message', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if (!empty($brand->image) &&  Storage::disk('public')->exists('uploads/brands/' . $brand->image)) {
            Storage::disk('public')->delete('uploads/brands/' . $brand->image);
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')->with('message', 'Brand deleted successfully.');
    }
}
