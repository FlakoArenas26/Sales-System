<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Feature;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with('feature')->latest()->get();
        return view("brand.index", compact("brands"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("brand.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        try {
            DB::beginTransaction();
            $feature = Feature::create($request->validated());
            $feature->brand()->create([
                'feature_id' => $feature->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('brand.index')->with('error', '¡Ocurrió un error al crear la marca!');
        }

        return redirect()->route('brand.index')->with('success', '¡Marca creada exitosamente!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('brand.edit', compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        Feature::where('id', $brand->feature->id)
            ->update($request->validated());

        return redirect()->route(route: 'brand.index')->with('success', '¡Marca actaulizada exitosamente!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $brand = Brand::find($id);
        if ($brand->feature->status == 1) {
            Feature::where('id', $brand->feature->id)
                ->update([
                    'status' => 0,
                ]);
            $message = '¡Marca eliminada exitosamente!';
        } else {
            Feature::where('id', $brand->feature->id)
                ->update([
                    'status' => 1,
                ]);
            $message = '¡Marca restaurada exitosamente!';
        }

        return redirect()->route('brand.index')->with('success', $message);

    }
}
