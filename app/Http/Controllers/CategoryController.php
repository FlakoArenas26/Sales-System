<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Feature;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('feature')->latest()->get();
        return view("category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $feature = Feature::create($request->validated());
            $feature->category()->create([
                'feature_id' => $feature->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('category.index')->with('error', '¡Ocurrió un error al crear la categoría!');
        }

        return redirect()->route('category.index')->with('success', '¡Categoría creada exitosamente!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        Feature::where('id', $category->feature->id)
            ->update($request->validated());

        return redirect()->route(route: 'category.index')->with('success', '¡Categoría actaulizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $category = Category::find($id);
        if ($category->feature->status == 1) {
            Feature::where('id', $category->feature->id)
                ->update([
                    'status' => 0,
                ]);
            $message = '¡Categoría eliminada exitosamente!';
        } else {
            Feature::where('id', $category->feature->id)
                ->update([
                    'status' => 1,
                ]);
            $message = '¡Categoría restaurada exitosamente!';
        }

        return redirect()->route('category.index')->with('success', $message);

    }
}
