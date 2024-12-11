<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePresentationRequest;
use App\Http\Requests\UpdatePresentationRequest;
use App\Models\Feature;
use App\Models\Presentation;
use Illuminate\Support\Facades\DB;

class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentations = Presentation::with('feature')->latest()->get();

        return view("presentation.index", compact("presentations"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("presentation.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresentationRequest $request)
    {
        try {
            DB::beginTransaction();
            $feature = Feature::create($request->validated());
            $feature->presentation()->create([
                'feature_id' => $feature->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('presentation.index')->with('error', '¡Ocurrió un error al crear la Presentación!');
        }

        return redirect()->route('presentation.index')->with('success', '¡Presentación creada exitosamente!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Presentation $presentation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presentation $presentation)
    {
        return view('presentation.edit', compact('presentation'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresentationRequest $request, Presentation $presentation)
    {
        Feature::where('id', $presentation->feature->id)
            ->update($request->validated());

        return redirect()->route(route: 'presentation.index')->with('success', '¡Presentación actaulizada exitosamente!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $presentation = presentation::find($id);
        if ($presentation->feature->status == 1) {
            Feature::where('id', $presentation->feature->id)
                ->update([
                    'status' => 0,
                ]);
            $message = '¡Presentación eliminada exitosamente!';
        } else {
            Feature::where('id', $presentation->feature->id)
                ->update([
                    'status' => 1,
                ]);
            $message = '¡Presentación restaurada exitosamente!';
        }

        return redirect()->route('presentation.index')->with('success', $message);

    }
}
