<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Venta::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $venta = Venta::create($request->all());
        return response()->json($venta, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Venta::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $venta = Venta::find($id);
        $venta->update($request->all());
        return response()->json($venta, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Venta::destroy($id);
        return response()->json(null, 204);
    }
}
