<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Presentation;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('feature')->latest()->get();
        return view("product.index", compact("products"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::join('features as f', 'brands.feature_id', '=', 'f.id')
            ->where('f.status', '=', 1)
            ->get();

        $presentations = Presentation::join('features as f', 'presentations.feature_id', '=', 'f.id')
            ->where('f.status', '=', 1)
            ->get();

        $categories = Category::join('features as f', 'categories.feature_id', '=', 'f.id')
            ->where('f.status', '=', 1)
            ->get();

        return view("product.create", compact('brands', 'presentations', 'categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
