<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($this->product)

            ],
            'slug' => 'string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'stock_status' => [
                'required',
                'string',
                Rule::in(['in_stock', 'out_of_stock'])
            ],
            'featured' => 'boolean',
            'quantity' => 'required|integer|min:0',
            'image' => 'mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
            'category_id' => 'nullable|integer|exists:categories,id',
            'brand_id' => 'nullable|integer|exists:brands,id'
        ];
    }
}
